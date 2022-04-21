import { get } from "./WebRequest.js";

async function getAllResults() {
  let results = await get("../server/show_table.php");
  console.log(results);
  return JSON.parse(results);
}

async function populateTable() {
  let results = await getAllResults();

  let resultsDiv = $("#quiz_results");

  resultsDiv.html("");

  for (let r of results) {
    let row = $("<tr></tr>");

    for (let col in r) {
      row.append(`<td>${r[col]}</td>`);
    }

    resultsDiv.append(row);
  }
}

populateTable();
