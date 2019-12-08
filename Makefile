localization:
	php artisan localization;
autoload:
	composer dump-autoload;
refresh:
	php artisan custom:refresh;
init:
	make add-support
	docker exec -it web_advanced_server bash -c 'composer install --ignore-platform-reqs && cp -R ./support_me ~/'
add-support:
	sudo rm -rf support_me
	mkdir support_me
	cp -R ~/.oh-my-zsh ./support_me
	cp ~/.zshrc ./support_me
docker-connect:
	docker exec -it web_advanced_server /bin/zsh
docker-start:
	docker-compose up -d --build;
