
const btn = document.getElementById('btn');
btn.addEventListener('click', ()=>{
const table = document.getElementById('table');
const tr = document.getElementById('tr');
const clone = tr.cloneNode(true);
clone.id = "";
var rm = document.createElement('button');
var i = document.createElement('i');
i.className = "bi bi-x-lg";
 rm.appendChild(i);
 rm.className = "btn btn-danger m-2";
 rm.type = "button";
 rm.onclick=()=>{
    rm.parentNode.parentNode.parentNode.removeChild(rm.parentNode.parentNode);
 }
var td = document.createElement("td");
td.appendChild(rm);
clone.appendChild(td);
table.appendChild(clone);
})
