# Nette React Template

This project is a ready-to-use starter template using the following technologies:
- Nette + Vite
- React + TypeScript
- Tailwind CSS v4
- MariaDB

It includes a Docker Compose setup designed for local development.
You don’t need to install anything manually — just run a few commands and you’re ready to go.

## 🚀 Quick start

> __Prerequisites:__ Docker + Docker Compose

### Using Docker Compose

1. Start the stack:
```
docker compose up --build -d
```
2. Install PHP dependencies and Node modules
```
docker exec nette_react_template_php sh -c "composer install && npm install"
```
3. Launch the Vite dev server (frontend hot‑reload)
```
docker exec -it nette_react_template_php npm run dev
```

- hit `q` + `enter` to stop dev server

🎉 Application is running on http://localhost:8000/.

> __Note:__ Nette uses the dev server only when debug mode is enabled (no action needed it's default setup)

### 🏗️ Prod build

Compile JS/CSS assets
```
docker exec nette_react_template_php npm run build
```

## Project structure

```
├── app/              # application (presenters, templates, components)
├── assets/           # React, Tailwind CSS, and other styles
├── bin/              # scripts for command line
├── config/           # configuration
├── database/         # database seed script
├── log/              # logged messages and errors
├── temp/             # temporary files, cache
├── tests/            # tests
├── vendor/           # libraries installed by Composer
└── www/              # public document root (index.php, built assets)
```

> __Note:__ docker compose up automatically seeds MariaDB on first run using database/init.sql.

> __Docs:__ See the [official Nette directory structure](https://doc.nette.org/en/application/directory-structure#toc-basic-project-structure) documentation for more details.

## Common Commands

### Stop containers
```
docker compose down
```

### Format code
```
docker exec nette_react_template_php composer format
```

### Database access
```
docker exec -it nette_react_template_mysql mysql -uroot -proot
```

or connect via database viewer (disable SSL)

### Remove docker volume with database data
```
docker volume rm nette-react-template_db_data
```
