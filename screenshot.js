// screenshot.js
const puppeteer = require('puppeteer');

async function takeScreenshot(url, width, height, format, outputPath, outputWidth, outputHeight) {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();
    await page.setViewport({ width: parseInt(width), height: parseInt(height) });
    await page.goto(url, { waitUntil: 'networkidle2' }); // wait until the page is fully loaded

    // If output dimensions are provided, resize the screenshot
    if (outputWidth && outputHeight) {
        await page.setViewport({ width: parseInt(outputWidth), height: parseInt(outputHeight) });
    }

    await page.screenshot({ path: outputPath, type: format });
    await browser.close();
}

const args = process.argv.slice(2);
const [url, width, height, format, outputPath, outputWidth, outputHeight] = args;

takeScreenshot(url, width, height, format, outputPath, outputWidth, outputHeight)
    .then(() => console.log('Screenshot taken'))
    .catch(err => console.error('Error taking screenshot', err));
