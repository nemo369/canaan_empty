const fs = require('fs') 
const path = require('path');
const { parse, stringify } = require('envfile')

function readEnvFile() {
    envFile = fs.readFileSync('.env', {encoding:'utf8', flag:'r'});
    return envFile
  }
 const sourcePath = readEnvFile()
  
let parsedFile = parse(sourcePath);
console.log(parsedFile)
parsedFile.IS_DEV = 'false'
fs.writeFileSync('./.env',stringify(parsedFile)) 



// MOVE FILES LOCATIONS
const orignalFolder = __dirname + '/../dist';
const buildFolder = `${__dirname}/../wp-content/themes/canaan/build`;


// DELETE EXISTING FILES 
fs.readdir(buildFolder, (err, files) => {
    if (err) throw err;
    for (const file of files) {
      fs.unlink(path.join(buildFolder, file), err => {
        if (err) throw err;
      });
    }
  });

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