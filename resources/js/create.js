document.addEventListener('DOMContentLoaded', function(){
    const txtSvg = document.querySelector('#txtSvg');
    const previewSvg = document.querySelector('.preview-svg');

    txtSvg.addEventListener('blur', function(){
        const svg = this.value;
        previewSvg.innerHTML = svg;
    })

    txtSvg.addEventListener('keyup', function(e){
        if (e.key === 'Enter') {
            e.preventDefault();
            const svg = this.value;
            previewSvg.innerHTML = svg;
            this.blur();
        }
    })
})