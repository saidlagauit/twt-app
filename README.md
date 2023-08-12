# twt-app - Social Media Platform

twt-app is a social media platform built using the Laravel framework. It allows users to create accounts, log in, edit their profiles, write articles, post comments, and manage their posts.

## Features

- User Authentication: Users can create accounts and log in securely.
- Profile Management: Users can edit their profiles, update profile pictures, and change account information.
- Article Creation: Users can write and publish articles.
- Commenting: Users can post comments on articles.
- Post Management: Users can edit and delete their articles.

## Installation

1. Clone the repository:

```bash
git clone https://github.com/saidlagauit/twt-app.git
```

2. Navigate to the project directory:

```bash
cd twt-app
```

3. Install Composer dependencies:

```bash
composer install
```

4. Install dependencies

```bash
npm install
```

5. Copy the `.env.example` file to `.env` and configure your database settings.

6. Generate the application key:

```bash
php artisan key:generate
```

7. Run database migrations:

```bash
php artisan migrate
```

8. Start the development server:

```bash
php artisan serve
```

## Usage

- Register a new account and log in.
- Update your profile information and profile picture.
- Create new articles and publish them.
- Interact with articles by posting comments.
- Manage your articles by editing or deleting them.
