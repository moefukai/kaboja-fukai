# あくまでサンプルなのでプロジェクトに合わせてカスタマイズしてね.
FROM node:16.13-alpine as node
WORKDIR /work
COPY laravel/package.json source/package-lock.json laravel/webpack.mix.js ./
COPY laravel/resources resources
RUN npm ci
RUN npm run production

FROM nginx:1.21.5-alpine
SHELL ["/bin/ash", "-oeux", "pipefail", "-c"]

ENV TZ='Asia/Tokyo'

RUN apk update && \
  apk add --update --no-cache --virtual=.build-dependencies g++

WORKDIR /work/laravel
# nginx config file
COPY ./infra/docker/production/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY ./laravel/public ./public
COPY --from=node /work/public/js ./public/js
COPY --from=node /work/public/css ./public/css

