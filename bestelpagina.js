const chairs = document.querySelectorAll(".chair");
const selectedSeats = [];

chairs.forEach(chair => {
  chair.addEventListener("click", () => {
    chair.classList.toggle("selected");
    const seatInput = document.getElementById("selectedSeatsInput") 
    const row = chair.dataset.row;
    const seat = chair.dataset.seat;
    const seatNumber = row + seat;
    if (!chair.classList.contains("taken")) {
    if (chair.classList.contains("selected")) {
      console.log(`Stoel ${seatNumber} is geselecteerd ✅`);
      selectedSeats.push(seatNumber);
      console.log(selectedSeats);
    } else {
      console.log(`Stoel ${seatNumber} is gedeselecteerd ❌`);
      const index = selectedSeats.indexOf(seatNumber);
      selectedSeats.splice(index, 1);
      console.log(selectedSeats);
    }
  }
    seatInput.value = selectedSeats
    
    console.log(selectedSeats, 'test')
  });
});

// const form = document.getElementById("myForm");
// const seatInputs = document.getElementById("SelectedSeatInputs");

// form.addEventListener("submit", () => {
//   console.log('click')
//   // Maak de oude inputs leeg
//   seatInputs.innerHTML = selectedSeats;
  

//   // Voor elke stoel een eigen input
//   // selectedSeats.forEach(seat => {
//   //   const input = document.createElement("input");
//   //   // input.type = "hidden";
//   //   input.name = "selectedSeats[]";  // let op: [] aan het eind!
//   //   input.value = seat;
//   //   seatInputs.appendChild(input);
//   // });
// });






