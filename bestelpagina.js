const chairs = document.querySelectorAll(".chair");

chairs.forEach(chair => {
  chair.addEventListener("click", () => {
    chair.classList.toggle("selected");

    const row = chair.dataset.row;   
    const seat = chair.dataset.seat; 
    const seatNumber = row + seat;
    if (chair.classList.contains("selected")) {
      console.log(`Stoel ${seatNumber} is geselecteerd ✅`);
    } else {
      console.log(`Stoel ${seatNumber} is gedeselecteerd ❌`);
    }
  });
});





