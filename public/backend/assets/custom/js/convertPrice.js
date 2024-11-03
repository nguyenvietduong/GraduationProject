function convertPrice(idElement1, idElement2) {
    const inputCurrent = document.getElementById(idElement1);
    const inputTransfer = document.getElementById(idElement2);
    inputCurrent.currency == "VND" ? inputTransfer.value = inputCurrent.value / @json(USD) : inputTransfer.value = inputCurrent.value * @json(USD);
}
console.log("oke");