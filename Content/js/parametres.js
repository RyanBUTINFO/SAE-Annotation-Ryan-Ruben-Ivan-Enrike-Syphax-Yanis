document.getElementById("bouton_param").addEventListener("click", () => {
    document.getElementById("param").hidden=false;
    document.getElementById("cond").hidden=true;
}
);
document.getElementById("bouton_cond").addEventListener("click", () => {
    document.getElementById("param").hidden=true;
    document.getElementById("cond").hidden=false;
}
);