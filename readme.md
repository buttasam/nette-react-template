# Nette React Template

This project is a starter template using the following technologies:
- Nette + Vite
- React + TypeScript
- Tailwind CSS v4
- MariaDB

It includes a Docker Compose setup designed for local development.
You don’t need to install anything manually — just run a few commands and you’re ready to go.

## Run locally

### Using Docker Compose

Run Docker Compose and install dependencies:

```
docker compose up --build -d
docker exec nette_react_template_php composer install
```

Run node dev server
```
docker exec -it nette_react_template_php npm install
docker exec -it nette_react_template_php npm run dev
```
- hit `q` + `enter` to stop dev server

🎉 Application is running on http://localhost:8000/.

Note:
- Nette uses the dev server only when debug mode is enabled (no action needed it's default setup)

### Prod build

```
docker exec nette_react_template_php npm run build
```

## Common Commands

### Stop containers:
```
docker compose down
```

### Format code
```
docker exec nette_react_template_php composer format
```
