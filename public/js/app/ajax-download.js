console.log("it is working!")

window.downloadQr = function(url, filename) {
    fetch(url)
        .then(response => response.blob())
        .then(blob => {
            // Create a link element and trigger a download
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = filename;
            link.click();
        });
}
