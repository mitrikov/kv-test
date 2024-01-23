# Сборка приложения
FROM node:lts-alpine3.18 as build-deps
COPY package*.json .
RUN npm ci
COPY . .
RUN npm run build

# Создание контейнера c nginx
FROM nginx:alpine
COPY --from=build-deps /dist /usr/share/nginx/html
COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf
WORKDIR /usr/share/nginx/html
EXPOSE 5175
