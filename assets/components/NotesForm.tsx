import React, { useState, useEffect, FormEvent, JSX } from "react";

interface Note {
  id: string;
  content: string;
}

const API = "/api/notes";

export default function NotesForm(): JSX.Element {
  const [notes, setNotes] = useState<Note[]>([]);
  const [input, setInput] = useState("");

  useEffect(() => {
    fetch(API)
      .then((r) => r.json())
      .then(setNotes);
  }, []);

  const addNote = async (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const content = input.trim();
    if (!content) return;

    const res = await fetch(API, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ content }),
    });
    const note: Note = await res.json();
    setNotes([note, ...notes]);
    setInput("");
  };

  const deleteNote = async (id: string) => {
    await fetch(`${API}/${id}`, { method: "DELETE" });
    setNotes(notes.filter((n) => n.id !== id));
  };

  return (
    <div className="mx-auto w-full 'max-w-4xl' p-6 rounded-2xl border bg-white ">
      <form onSubmit={addNote} className="flex gap-4">
        <input
          className="flex-1 px-4 py-3 border rounded-xl"
          placeholder="Write a new note..."
          value={input}
          onChange={(e) => setInput(e.target.value)}
        />
        <button
          type="submit"
          disabled={!input.trim()}
          className="px-5 py-3 font-semibold text-white rounded-xl bg-blue-600 hover:bg-blue-700 disabled:opacity-50"
        >
          Add
        </button>
      </form>

      <ul className="mt-6 space-y-4">
        {notes.map(({ id, content }) => (
          <li
            key={id}
            className="flex items-center justify-between px-5 py-3 border rounded-xl bg-gray-50"
          >
            <span className="text-base text-gray-800">{content}</span>
            <button
              aria-label="Delete"
              onClick={() => deleteNote(id)}
              className="text-xl leading-none text-red-500 hover:text-red-700"
            >
              ×
            </button>
          </li>
        ))}
      </ul>
    </div>
  );
};