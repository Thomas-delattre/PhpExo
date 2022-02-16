// ~~~~~~~~~~~~~~~~~~~~~~ 'Resa' section Events ~~~~~~~~~~~~~~~~~~~~~~

const resaButtons = document.querySelectorAll(".resaAvailable");
const resaHourLines = document.querySelectorAll(".resaHourLine");
let bookingTimeId = document.getElementById("bookingTime");
let resaButtonClicked = false;
let resaHourB, resaHourL = "";
let resaData = new Object();

// changes the resa button opacity when clicked
resaButtons.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    resaButtons.forEach((btn) => {
      btn.style.opacity = "1";
    });
    if (resaButtonClicked == false) {
      btn.style.opacity = "0.5";
      resaButtonClicked = true;
	  bookingTimeId.value = btn.dataset.scheduleId;
	  
    } else {
      btn.style.opacity = "1";
      resaButtonClicked = false;
    }
    // gets DOM object value depending on the browser
    if(navigator.userAgent.match(/firefox|fxios/i)){
      resaHourB = e.explicitOriginalTarget.offsetParent.childNodes[1].childNodes[0].data;
    } else {
      resaHourB = e.path[1].childNodes[1].childNodes[0].data;
	  
    }
	console.log(resaHourB);
  });
});

// gets the hour value of the selected line
resaHourLines.forEach((line) => {
  line.addEventListener('click', (e) => {
    // gets DOM object value depending on the browser
    if(navigator.userAgent.match(/firefox|fxios/i)){
      resaHourL = e.explicitOriginalTarget.offsetParent.childNodes[1].childNodes[0].data;
    } else {
      resaHourL = e.path[1].childNodes[1].childNodes[0].data;
    }
    if (resaHourL == "Réserver" || resaHourL == "Complet") {
      resaHourL = resaHourB;
    }
    e.target.classList.toggle("isSelected");
  });
});

// get all elements when "Suivant" button is clicked
resaNextButton.addEventListener('click', () => {
  // creates & feeds an object 'resaData' with 4 key-value pairs
  if (roomSelect.value != "" && playersNumber.value != "" && resaGameDate.value != "" && resaHourL != "") {
    resaData = new Object();
    resaData.room = roomSelect.value;
    resaData.playersNumber = playersNumber.value;
    resaData.gameDate = resaGameDate.value;
    resaData.gameHour = resaHourL;
    displayData(resaData);
  } else {
    alert("Merci de renseigner: la salle, le nombre de joueurs, la date et l'heure de votre partie.");
  }
});

// returns a human readable room name, instead of the keyword of the input value
function convertRoomName(name) {
  switch (name) {
    case 'star-wars':
      return "Les rebelles de l'étoile";
    case 'castle':
      return "Le château ambulant";
    case 'chucky':
      return "Chucky";
    case 'underground':
      return "Les souterrains de Bordeaux";
    default:
      null;
  }
}

// displays the 'resaData' Object details on the 'recap Section' of the DOM
function displayData(data) {
  recapRoom.innerHTML = "Salle: " + convertRoomName(data.room);
  recapPlayers.innerHTML = "Nombre de joueurs: " + data.playersNumber;
  recapDate.innerHTML = data.gameDate + " - " + data.gameHour;
}

// Resa-Recap 'modal'
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Reset form 'input' elements values
function clearForm() {
  recapFormName.value = "";
  recapFormPhone.value = "";
  recapFormEmail.value = "";
}

// When the user clicks the button, open the modal 
resaNextButton.addEventListener('click', () => {
  myModal.style.display = "block";
});

// When the user clicks on <span> (x), close the modal and reset the form
span.addEventListener('click', () => {
  myModal.style.display = "none";
  clearForm();
});

// When the user clicks the button '< Réservation', close the modal and reset the form
btnReturnToResa.addEventListener('click', () => {
  myModal.style.display = "none";
  clearForm();
});

// When the user clicks anywhere outside of the modal, close it and reset the form
window.addEventListener('click', (e) => {
  if (e.target == myModal) {
    myModal.style.display = "none";
    clearForm();
  }
});

// checks the email integrity
function emailIsValid(mail) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
  {
    return (true)
  }
    alert("Il semble que l'adresse email que vous avez saisie soit invalide!")
    return (false)
}

// checks the phone number integrity
function phoneNumberIsValid(phoneNum) 
{
 if (/^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$/.test(phoneNum))
  {
    return (true)
  }
    alert("Il semble que le numéro de téléphone que vous avez saisi soit invalide!")
    return (false)
}

// 
btnConfirmResa.addEventListener('click', () => {
  if (recapFormName.value  && recapFormPhone.value && recapFormEmail.value) {
    if (emailIsValid(recapFormEmail.value) && phoneNumberIsValid(recapFormPhone.value)) {
      alert("Réservation confirmée!");
      clearForm();
      myModal.style.display = "none";
    };
  } else {
    alert("Merci de bien vouloir saisir vos nom, téléphone et email");
  }
});

// Selects the parent roomCard number of the clicked 'résa' button and redirects to resa section with the good room pre-selected
document.querySelectorAll('.roomResaButton').forEach((btn) => {
  btn.addEventListener('click', (e) => {
    let roomCardNumber = navigator.userAgent.match(/firefox|fxios/i) ? e.explicitOriginalTarget.offsetParent.id : e.path[2].id;
    switch (roomCardNumber) {
      case 'roomCard1':
        roomSelect.value = "castle";
        break;
      case 'roomCard2':
        roomSelect.value = "chucky";
        break;
      case 'roomCard3':
        roomSelect.value = "underground";
        break;
      case 'roomCard4':
        roomSelect.value = "star-wars";
        break;
      default:
        null;
    }
    resaSection.scrollIntoView({behavior: 'smooth'});
  });
});

document.querySelectorAll('.roomCard').forEach((card) => {
  card.addEventListener('mouseover', () => {
    card.childNodes[1].childNodes[3].childNodes[6].style.display = "block";
    card.childNodes[1].childNodes[5].style.display = "block";
  });

  card.addEventListener('mouseout', (e) => {
    card.childNodes[1].childNodes[3].childNodes[6].style.display = "none";
    card.childNodes[1].childNodes[5].style.display = "none";
  });

});