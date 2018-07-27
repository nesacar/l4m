/**
 * @param {string} str
 * @return {number}
 */
export const charCount = (str) => {
  const rgx = /<[^>]*>/g;
  return str.replace(rgx, '').length;
}


