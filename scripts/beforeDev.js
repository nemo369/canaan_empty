const fs = require('fs') 
const { parse, stringify } = require('envfile')

function readEnvFile() {
    envFile = fs.readFileSync('.env', {encoding:'utf8', flag:'r'});
    return envFile
  }
 const sourcePath = readEnvFile()
  
let parsedFile = parse(sourcePath);
console.log(parsedFile)
parsedFile.IS_DEV = 'true'
fs.writeFileSync('./.env',stringify(parsedFile)) 