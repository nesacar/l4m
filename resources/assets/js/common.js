export default (arr, id) => {
    var index = arr.indexOf(id);

    (index > -1)
        ? arr.splice(index, 1)
        : arr.push(id);
};


