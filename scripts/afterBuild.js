const fs = require('fs') 
const path = require('path');
const { parse, stringify } = require('envfile')

function readEnvFile() {
    envFile = fs.readFileSync('.env', {encoding:'utf8', flag:'r'});
    return envFile
  }
 const sourcePath = readEnvFile()
  
let parsedFile = parse(sourcePath);
console.log('Switched to PROD Mode')
parsedFile.IS_DEV = 'false'
fs.writeFileSync('./.env',stringify(parsedFile)) 



// MOVE FILES LOCATIONS
const orignalFolder = __dirname + '/../dist';
const buildFolder = `${__dirname}/../wp-content/themes/canaan/build`;


// DELETE EXISTING FILES 
// fs.rmSync(buildFolder, { recursive: true });
const deleteFolderRecursive = function (directoryPath) {
  if (fs.existsSync(directoryPath)) {
      fs.readdirSync(directoryPath).forEach((file, index) => {
        const curPath = path.join(directoryPath, file);
        if (fs.lstatSync(curPath).isDirectory()) {
         // recurse
          deleteFolderRecursive(curPath);
        } else {
          // delete file
          fs.unlinkSync(curPath);
        }
      });
      fs.rmdirSync(directoryPath);
    }
  };

deleteFolderRecursive(buildFolder);
fs.mkdirSync(buildFolder);
if (!fs.existsSync(orignalFolder)) {
    console.log('PLEASE BUILD PROJECT FIRST');
    return;
}

fs.readdir(`${orignalFolder}`, (err, files) => {
    files.forEach(file => {
        moveFiles(file);
    });
});


const moveFiles = (fileName) => {
    fs.rename(`${orignalFolder}/${fileName}`, `${buildFolder}/${fileName}`, (err) => {
        console.log(err ? err : `${fileName} Moved`);
    })
}