Store app test project

### Installation with docker

**1. Clone the project**
```bash
https://github.com/Kazturin/store-test-project.git
```

**2. Run `composer install`**

Navigate to project folder

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

**3. Start the project in detached mode**

```bash
./vendor/bin/sail up -d
```

```bash
./vendor/bin/sail bash
```

**4. Run migrations**

```bash
php artisan migrate
```

```bash
php artisan db:seed
```

**5. Run NPM**

```bash
npm install
```
```bash
npm run build
```

http://localhost - admin <br>
http://localhost:3000 - client
