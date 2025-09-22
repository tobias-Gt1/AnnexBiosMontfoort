const chairs = document.querySelectorAll(".chair");
const selectedSeats = [];

chairs.forEach(chair => {
  chair.addEventListener("click", () => {
    chair.classList.toggle("selected");

    const row = chair.dataset.row;   
    const seat = chair.dataset.seat; 
    const seatNumber = row + seat;
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
  });
});





