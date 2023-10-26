FROM node:21-alpine3.17 as build-stage

WORKDIR /app
COPY package*.json ./
RUN npm install
COPY ./ .
RUN npm run build

FROM nginx as production-stage
EXPOSE 3000
RUN mkdir /app
COPY ../nginx/conf.d/nginx.conf /etc/nginx/conf.d/default.conf
COPY --from=build-stage /app/dist /app
