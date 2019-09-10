const divNaslov=document.getElementById("naslov");
const divZene=document.getElementById("zene");
const divMuski=document.getElementById("muski");
const divIme=document.querySelector("input[name='ime']");
const divPrezime=document.querySelector("input[name='prezime']");
const divForma=document.getElementById("forma");

vratiSve();

function vratiSve()
{
	fetch("indexSmena.php")
		.then(response=>{
			if(!response.ok)
				throw new Error(response.statusText);
			else
			{
				return response.json();
			}
		})
		.then(smena=>crtajTabelu(smena))
		.catch(error=>console.log("Greska je : "+error.statusText));
}

function crtajTabelu(smena)
{
	divNaslov.innerHTML="Smena: " + smena.dan + ", " + smena.datum;
	let z=0;
	let m=0;
	smena.lista.forEach(el=>{
		if(el.pol=="Z")
			z++;
		else if(el.pol=="M")
			m++;
	});

	divZene.innerHTML="Broj zenskih lekara: "+z;
	divMuski.innerHTML="Broj muskih lekara: "+m;

	const tabela=document.querySelector("table");
	let tabelaHTML="<thead><th>Ime</th><th>Prezime</th><th>Pol</th><th>Radno vreme</th><th>Izmeni</th></thead><tbody>";
	smena.lista.forEach(el=>{
		tabelaHTML+="<tr><td>"+el.ime+"</td><td>"+el.prezime+"</td><td>"+el.pol+"</td><td>"+el.radno_vreme+"</td><td><input type='radio' name='izmeni' id="+el.id+" value="+el.id+"></td></tr>";

	})
	tabelaHTML+="</tbody";
	tabela.innerHTML=tabelaHTML;
	document.getElementById("azuriraj").onclick=(ev)=>vratiLekara(ev.target);
}

function vratiLekara(ev)
{
	fetch("indexLekar.php?id="+document.querySelector("input[name='izmeni']:checked").value)
		.then(response=>{
			if(!response.ok)
				throw new Error(response.statusText);
			else
			{
				return response.json();
			}
		})
		.then(lekar=>crtajFormu(lekar))
		.catch(error=>console.log("Greska je : "+error.statusText));

}

function crtajFormu(lekar)
{
	divForma.hidden=false;
	divIme.value=lekar.ime;
	divPrezime.value=lekar.prezime;

	if(lekar.pol=="Z")
	{
		document.querySelector("input[value='z']").checked=true;
		document.querySelector("input[value='m']").checked=false;
	}
	else if(lekar.pol=="M")
	{
		document.querySelector("input[value='z']").checked=false;
		document.querySelector("input[value='m']").checked=true;
	}

	if(lekar.radno_vreme=="prepodne")
	{
		document.querySelector("input[value='prepodne']").checked=true;
		document.querySelector("input[value='popodne']").checked=false;
	}
	else if(lekar.radno_vreme=="popodne")
	{
		document.querySelector("input[value='prepodne']").checked=false;
		document.querySelector("input[value='popodne']").checked=true;
	}

	document.getElementById("sacuvaj").onclick=(ev)=>sacuvaj(lekar);
}

function sacuvaj(lekar)
{
	divForma.hidden=true;
	const forma=new FormData();
	forma.append("id",lekar.id );
	forma.append("ime", divIme.value);
	forma.append("prezime", divPrezime.value);
	forma.append("pol", document.querySelector("input[name='pol']:checked").value);
	forma.append("radno_vreme", document.querySelector("input[name='vreme']:checked").value);

	const fetchData={
		method:"post",
		body:forma
	}

	fetch("indexSmena.php",fetchData)
		.then(response=>{
			if(!response.ok)
				throw new Error(response.statusText);
			else
			{
				return response.json();
			}
		})
		.then(smena=>crtajTabelu(smena))
		.catch(error=>console.log("Greska je : "+error.statusText));
}
