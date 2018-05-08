addEventListener('message', d => {
  const imageData = d.data;
  const w = imageData.width;
  const h = imageData.height;
  const data = imageData.data;
  const colorArray = [0, 0, 0];

  for (let x = 0; x < w; x++) {
    for (let y = 0; y < h; y++) {
      let index = (x + (y * w)) * 4;
      colorArray[0] += data[index];
      colorArray[1] += data[index + 1];
      colorArray[2] += data[index + 2];
    }
  }

  const len = w * h;
  const red = colorArray[0] / len;
  const green = colorArray[1] / len;
  const blue = colorArray[2] / len;
  const luma = (red * 0.2126) + (green * 0.7152) + (blue * 0.0722);

  postMessage(luma);
});
