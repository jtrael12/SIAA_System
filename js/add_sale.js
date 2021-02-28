var table = document.getElementById("table"), rIndex ,cIndex;

// table rows
for (var i = 1; i < table.rows.length; i++) {
    table.rows[i].cells[7].onclick = function () {
        //checker only for rows and cols ito sa console icheck
        rIndex = this.parentElement.rowIndex;
        cIndex = this.cellIndex;
        console.log("Row : " + rIndex + " , Cell : " + cIndex);

        //real deal:
        var index = rIndex - 1;
        document.querySelector('.bg-modal').style.display = "flex";
        document.querySelector('.mClose').addEventListener('click',
            function () {
                document.querySelector('.bg-modal').style.display = "none";
                document.getElementById('txsold').value = '';
            }
        );
        var prod = data[index].toString();
        document.getElementById('txtproduct').value = prod;
        var qty = data_qty[index].toString();
        document.getElementById("txsold").max = qty;
    };
}