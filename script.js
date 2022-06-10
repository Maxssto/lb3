window.onload = () => {
    const wardForm = document.getElementById("ward");

    wardForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const ward = new FormData(this);

        fetch("tmp.php", {
            method: "post",
            body: ward
        }).then(function (response){
            return response.text();
        }).then(function (text) {
            document.getElementById("download").innerHTML = text;
        }).catch(function (error) {
            console.error(error);
        });
    })

    const nurseForm = document.getElementById("nurse");

    nurseForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const nurse = new FormData(this);
        fetch("tmp.php", {
            method: "post",
            body: nurse
        }).then(function (response){
            return response.json();
        }).then(function (json) {
            document.getElementById("download").innerHTML = json;
        }).catch(function (error) {
            console.error(error);
        });
    })

    const dutyForm = document.getElementById("duty");

    dutyForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const duty = new FormData(this);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "tmp.php");
        xhr.responseType = 'document';
        xhr.send(duty);

        xhr.onload = () => {
            document.getElementById("download").innerHTML = xhr.responseXML.body.innerHTML;
        }
    })
}


