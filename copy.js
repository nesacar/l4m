const fs = require('fs');
const path = require('path');

const srcDir = path.join(__dirname, '/email/src');
const destDir = path.join(__dirname, '/email/dist');

// clean the dist folder
fs.readdirSync(destDir)
  .forEach((file) => {
    fs.unlinkSync(`${destDir}/${file}`);
  });

// copy the source files to the dist folder.
fs.readdirSync(srcDir)
  .forEach((srcFile) => {
    const content = fs.readFileSync(`${srcDir}/${srcFile}`, 'utf8');
    const destFile = srcFile.concat('.blade.php');
    fs.writeFileSync(`${destDir}/${destFile}`, content, 'utf8');
  });
