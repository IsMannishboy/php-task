from node
WORKDIR /app
copy package*.json ./
run npm install
copy . .
expose 5173
cmd ["npm","run","dev"]
