FROM node:alpine AS pnpm
RUN npm --global install pnpm

WORKDIR /root/monorepo

FROM pnpm AS base
COPY ./pnpm-lock.yaml .npmrc ./
RUN pnpm fetch --prod

FROM base AS dev
RUN pnpm fetch
COPY . ./
RUN pnpm install --offline

## This is ugly, but I'm having insane problems with symlinked crap
## And yeah.. I don't wanna spend another week on f*ckin docker
WORKDIR /root/monorepo/apps/personal

EXPOSE 1305
CMD [ "pnpm", "start" ]

# FROM dev
# WORKDIR /root/app
# COPY --from=dev /root/monorepo/apps/personal ./
