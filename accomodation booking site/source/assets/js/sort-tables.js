/**
 * Compares the columns
 * @param colnr
 * @returns {Function}
 */
function compareColumns(colnr) {
    return function(a, b) {
        var aa = a.querySelectorAll("td")[colnr].textContent;
        var bb = b.querySelectorAll("td")[colnr].textContent;
        if (aa < bb) { return -1; }
        if (aa > bb) { return 1; }
        return 0;
    };
}

/**
 * Sorts the table
 * @param tbl
 * @param colnr
 */
function sortTable(tbl, colnr) {
    var tbody = tbl.querySelector("tbody");
    var rows = tbody.querySelectorAll("tr");
    var rowsA = Array.prototype.slice.call(rows, 0);
    rowsA.sort(compareColumns(colnr));
    var newtbody = document.createElement("tbody");
    rowsA.forEach(function(r) { newtbody.appendChild(r); });
    tbl.replaceChild(newtbody, tbody);
}

/**
 * preserves the scope
 * @param a
 * @param b
 * @returns {Function}
 */
function scopePreserver(a, b) {
    return function() {
        sortTable(a, b);
    };
}

/**
 * selects the documents ids
 */
function registerSortables() {
    document.querySelectorAll(".sortable").forEach(function(s) {
        var hs = s.querySelectorAll("thead tr th");
        for (var i = 1; i < hs.length; i++) {
            hs[i].addEventListener("click", scopePreserver(s, i) );
        }
    });
}

/**
 * Waits for the DOM to load
 */
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", registerSortables);
} else {
    registerSortables();
}
