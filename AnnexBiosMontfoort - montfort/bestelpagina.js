// Stoelen selecteren
const chairs = document.querySelectorAll(".chair");
const ChairCounter = document.getElementById("totalChairs"); // optioneel: totaal stoelen teller
const ChairCheck = document.getElementById("chairCheck"); // toont geselecteerde stoelen
const selectedSeats = [];
const selectedSeatsInput = document.getElementById('selectedSeatsInput')

// Event listener voor stoel selectie
chairs.forEach(chair => {
  chair.addEventListener("click", () => {
    if (chair.classList.contains("taken")) return; // niet klikbare stoelen
      const seatInput = document.getElementById("selectedSeatsInput")


    chair.classList.toggle("selected");

    const row = chair.dataset.row;
    const seat = chair.dataset.seat;
    const seatNumber = row + seat;

    if (chair.classList.contains("selected")) {
      selectedSeats.push(seatNumber);
    } else {
      // splice de juiste index van seatNumber
      const index = selectedSeats.indexOf(seatNumber);
      if (index > -1) selectedSeats.splice(index, 1);
    }

    seatInput.value = selectedSeats
    ChairCheck.textContent = selectedSeats.join(", ");
    console.log('haahaafhdsalkjfhsakdjf;')
    updateDisplay();
  });
});

// Variabele voor correcte tickethoeveelheid
let CorrectTicketAmount = true;
function updateDisplay() {
  ChairCounter.textContent = selectedSeats.length

  if (ChairCounter.textContent == totalTickets.textContent) {
    ChairCounter.parentElement.style.color = "black";
    CorrectTicketAmount = true;
  } else {
    ChairCounter.parentElement.style.color = "red"; // maakt hele p rood
    CorrectTicketAmount = false
  }
}



// Ticket- en prijsupdate
const PriceDisplay = document.getElementById('totalPrice');
const TicketCheck = document.getElementById("ticketCheck");
console.log(ticketCheck)
const inputs = document.querySelectorAll('input[type="number"]');
const totalTicketsEl = document.getElementById('totalTickets');

function updateTotal() {
  console.log('update total')
  let ticketCheckText = '';
  let total = 0;
  let totalPrice = 0;

  inputs.forEach(input => {
    const count = parseInt(input.value) || 0;
    total += count;
    console.log(input.value)
    console.log(input.name)
    if (input.name === "normal" && count > 0) {
      ticketCheckText += count + 'x normaal ';
      totalPrice += count * 9;
    } else if (input.name === "child" && count > 0) {
      ticketCheckText += count + 'x child ';
      totalPrice += count * 5;
    } else if (input.name === "senior" && count > 0) {
      ticketCheckText += count + 'x senior ';
      totalPrice += count * 7;
    }
    console.log(ticketCheckText)
  });
  console.log(ticketCheckText)
  if (TicketCheck) TicketCheck.textContent = ticketCheckText;
  if (totalTicketsEl) totalTicketsEl.textContent = total;
  if (PriceDisplay) PriceDisplay.textContent = "€" + totalPrice.toFixed(2);

  updateDisplay();
}

// Event listener voor input velden
inputs.forEach(input => {
  input.addEventListener('input', updateTotal);
});

// Check bij reserveren
const reserveerBtn = document.getElementById("reserveer");

if (reserveerBtn) {
  reserveerBtn.addEventListener("click", (e) => {
    if (!CorrectTicketAmount) {
      e.preventDefault();
      const target = document.getElementById("totalTickets");
      if (target) target.scrollIntoView({ behavior: "smooth", block: "center" });
      alert("Aantal geselecteerde stoelen komt niet overeen met aantal tickets!");
    }
  });
}
