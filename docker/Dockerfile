FROM richarvey/nginx-php-fpm:latest

RUN apk add zsh make &&\
	sh -c "$(curl -fsSL https://raw.github.com/robbyrussell/oh-my-zsh/master/tools/install.sh)" &&\
	docker-php-ext-configure gd --with-png-dir=/usr/include/ && \
	docker-php-ext-install -j$(nproc) gd &&\
	docker-php-ext-install pdo_mysql bcmath opcache zip



