

var nizBlokova = ["prijavljeni", "neprijavljeni"];

function skloniBlokove(){
    for(const blok of nizBlokova){
        document.getElementById(blok).style.display="none";
    }
};

skloniBlokove();

function prikaziBlok(){


if(document.getElementById("radio_prijava").checked){
document.getElementById("neprijavljeni").style.display = "block";
document.getElementById("prijavljeni").style.display = "none";
}

if(document.getElementById("radio_odjava").checked){
document.getElementById("prijavljeni").style.display = "block";
document.getElementById("neprijavljeni").style.display = "none";
}
}

$("input[name=odabir_metode]").on('click',prikaziBlok);



