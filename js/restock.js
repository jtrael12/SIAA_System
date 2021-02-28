var table = document.getElementById("table"), rIndex, cIndex;

function change(id) {
    if (document.getElementsByTagName) {
        var table = document.getElementById(id);
        var row = table.getElementsByTagName("tr");
        for (var x = 0; x < data2.length; x++) {
            if (data2[x] <= 5) {
                row[x + 1].style.backgroundColor = "#ff7f7f";
            }
        }
    }
}

// table rows
for (var i = 1; i < table.rows.length; i++) {
    table.rows[i].cells[7].onclick = function () {
        rIndex = this.parentElement.rowIndex;
        cIndex = this.cellIndex;
        console.log("Row : " + rIndex + " , Cell : " + cIndex);

        var index = rIndex - 1;
        document.querySelector('.bg-modal').style.display = "flex";
        document.querySelector('.close').addEventListener('click',
            function () {
                document.querySelector('.bg-modal').style.display = "none";
            }
        );
        var prod = data[index].toString();
        document.getElementById('txtproduct').value = prod;

        var prod_id = dataID[index];
        document.getElementById('hidID').value = prod_id;

        var qty = data2[index].toString();
        document.getElementById('lblCurrent').innerHTML = qty;
        document.getElementById('hidQty').value = qty;
    };
}