# Grandis Business Website

A business website project for **Grandis — Build. Scale. Evolve.**, built with PHP and TiDB Cloud.

## Overview

This project combines a web frontend, a PHP backend, and a TiDB Cloud database to support a database-driven business website.

## Technology Stack

- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP 8.x
- **Database:** TiDB Cloud
- **Database access:** PHP PDO
- **Containerization:** Docker

## Project Structure

| File | Purpose |
|---|---|
| `index.php` | Main website entry point |
| `db.php` | Database connection configuration |
| `schema.sql` | Database schema |
| `style.css` | Website styling |
| `script.js` | Frontend interactions |
| `Dockerfile` | Container configuration |

## Configuration

Configure the following environment variables in your local environment or hosting platform:

```env
TIDB_HOST=your_database_host
TIDB_PORT=4000
TIDB_DB_NAME=your_database_name
TIDB_USER=your_database_user
TIDB_PASSWORD=your_database_password
```

Never commit real database credentials or private keys to GitHub.

## Getting Started

1. Clone the repository:

   ```bash
   git clone https://github.com/ayd-jamesjr/grandis-tidb-website.git
   cd grandis-tidb-website
   ```

2. Configure your TiDB Cloud connection using the environment variables above.

3. Import `schema.sql` into your TiDB database.

4. Ensure PHP 8.x and the PDO MySQL extension are available.

5. Run the application using a compatible PHP web server.

## Deployment

The project includes a Dockerfile and can be prepared for deployment on a compatible hosting platform. Hosting configuration, environment variables, and database connectivity should be verified before production use.

## Project Category

**Grandis / Greatness — Business & Technology Project**

---

*Build. Scale. Evolve.*