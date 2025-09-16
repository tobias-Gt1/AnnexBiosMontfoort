const chairs = document.querySelectorAll(".chair");

chairs.forEach(chair => {
  chair.addEventListener("click", () => {
    chair.classList.toggle("selected"); // toggle selectie visueel

    const seatNumber = chair.id; // haalt de unieke stoel-id op

    if (chair.classList.contains("selected")) {
      console.log(`Stoel ${seatNumber} is geselecteerd ✅`);
    } else {
      console.log(`Stoel ${seatNumber} is gedeselecteerd ❌`);
    }
  });
});
