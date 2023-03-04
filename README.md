# Setting up the environment

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

# Running the application

```bash
./vendor/bin/sail up -d
```

# Running the migrations

```bash
./vendor/bin/sail artisan migrate
```

# Running the seeders

```bash
./vendor/bin/sail artisan db:seed
```

# Running the tests

```bash
./vendor/bin/sail test
```

# Testing with Http Client

make sure you have the following in your .env file

```bash
SLACK_WEBHOOK_URL=
```

make a post request to the following endpoint

```bash
http://localhost/api/mails
```

An Alert will be sent to the slack channel when the mail sent has a Type of SpamNotification

