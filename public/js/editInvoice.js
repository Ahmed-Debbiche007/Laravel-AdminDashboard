const btn = document.getElementById('btn');
btn.addEventListener('click', () => {
    const table = document.getElementById('table');
    const tr = document.getElementById('tr');
    const clone = tr.cloneNode(true);
    table.appendChild(clone);
    const rm = document.querySelectorAll(".rm");
rm.forEach((rmbtn) => {
    rmbtn.onclick = () => {
        rmbtn.parentNode.parentNode.parentNode.removeChild(rmbtn.parentNode.parentNode);
    }
})
})