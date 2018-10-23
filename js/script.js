let HIDE_CLASS_NAME = 'hidden-object';
let listNameInput, listCreateBtn, listUpdateBtn, listDeleteBtn, listsContainer,itemsContainer;
let itemNameInput;
let selectedListId = 0;
let allListsArr = [];
let currentList;
let listItems = [];


document.addEventListener('DOMContentLoaded', function (event) {
    listNameInput = document.querySelector('#listNameInput');
    listCreateBtn = document.querySelector('#listCreateBtn');
    listUpdateBtn = document.querySelector('#listUpdateBtn');
    listDeleteBtn = document.querySelector('#listDeleteBtn');
    listsContainer = document.querySelector('#listsContainer');
    itemsContainer = document.querySelector('#itemsContainer');
    itemNameInput = document.querySelector('#itemNameInput');
    loadLists();
});

function addNewList() {
    let val = listNameInput.value;

    let d = new Date();
    let str = `${d.getFullYear()}-${d.getMonth()+1}-${d.getDate()}`;
    let dataString =
        'name=' + val +
        '&createDate=' + str +
        '&updateDate=' + str;

    let xhr = new XMLHttpRequest();

    xhr.open('POST', `php/addNewList.php`, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = () => {
        loadLists();
        listNameInput.value = '';
        itemsContainer.innerHTML = '';
    };
    xhr.send(dataString);
}

function updateList() {
    let val = listNameInput.value;

    let d = new Date();
    let str = `${d.getFullYear()}-${d.getMonth()+1}-${d.getDate()}`;
    let dataString =
        'id=' + currentList.id +
        '&name=' + val +
        '&updateDate=' + str;

    let xhr = new XMLHttpRequest();

    xhr.open('POST', `php/updateList.php`, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = () => {
        loadLists();
        listNameInput.value = '';
        itemsContainer.innerHTML = '';
    };
    xhr.send(dataString);
}

function deleteList() {
    let dataString = 'id=' + currentList.id;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', `php/deleteList.php`, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = () => {
        loadLists();
        listNameInput.value = '';
        currentList = null;
        selectedListId = 0;
        itemsContainer.innerHTML = '';
        hideElements();
    };
    xhr.send(dataString);
}

function addNewItemToList() {
    if(itemNameInput.value == '' || selectedListId == 0) return; 
    let val = itemNameInput.value;

    let dataString =
        'name=' + val +
        '&listId=' + selectedListId +
        '&isDone=' + 0;

    let xhr = new XMLHttpRequest();

    xhr.open('POST', `php/addListRecord.php`, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = () => {        
        getCurrentListItems(selectedListId);
        itemNameInput.value = '';
    };
    xhr.send(dataString);
}

function setCheckedInArr(id) {
    listItems = listItems.map(e => {
        if(id == e.id) {
            e.isDone = e.isDone == '0'?'1':'0';
        }
        return e;
    });
}

function updateListItem(id) {
    let itemInput = document.querySelector(`#inp${id}`);
    let val = itemInput.value;

    if(val == '') return;
    let ch;
    listItems.forEach(e => {
        if(id == e.id) {
            ch = e.isDone;               
        }
    });
    let d = ch=='1' ? '1' : '0';
    let dataString = 'id=' + id + '&name=' + val + '&isDone=' + d;
    
    let xhr = new XMLHttpRequest();
    xhr.open('POST', `php/updateRecord.php`, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = () => {
        getCurrentListItems(currentList.id);
    };
    xhr.send(dataString);
}

function deleteListItem(id) {
    let dataString = 'id=' + id;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', `php/deleteRecord.php`, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = () => {
        getCurrentListItems(currentList.id);
    };
    xhr.send(dataString);
}

function showAddListForm() {
    listNameInput.classList.remove(HIDE_CLASS_NAME);
    listCreateBtn.classList.remove(HIDE_CLASS_NAME);
    listUpdateBtn.classList.add(HIDE_CLASS_NAME);
    listDeleteBtn.classList.add(HIDE_CLASS_NAME);
    listNameInput.value = '';
    itemsContainer.innerHTML = '';
}

function showList(id) {
    selectedListId = id;
    getCurrentListItems(id);
    currentList = allListsArr.filter(e => {
        if (e.id == id) {
            return e;
        }
    })[0] || {};
    listNameInput.value = currentList.name;
    listNameInput.classList.remove(HIDE_CLASS_NAME);
    listCreateBtn.classList.add(HIDE_CLASS_NAME);
    listUpdateBtn.classList.remove(HIDE_CLASS_NAME);
    listDeleteBtn.classList.remove(HIDE_CLASS_NAME);
}

function loadLists() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'php/getAllLists.php', true);

    xhr.onload = function () {
        if (this.status == 200) {
            let lists = JSON.parse(this.responseText);
            allListsArr = lists;
            let output = '';
            for (let i in lists) {
                output += '<div class="one-shopping-list" onclick="showList('+ 
                 lists[i].id+')"><p class="list-name">'
                    + lists[i].name +
                    '</p></div>';
            }
            if(output == ''){
                output += '<div class="one-shopping-list"><p class="list-name">'
                    + 'No records' +
                    '</p></div>';
            }
            listsContainer.innerHTML = output;
        }
    }

    xhr.send();
}

function getCurrentListItems(id) {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'php/getListItemsByListId.php?id='+id, true);

    xhr.onload = function () {
        if (this.status == 200) {
            let items = JSON.parse(this.responseText);
            listItems = items;
            let output = '';
            for (let i in items) {
                ch = '';
                if(+items[i].isDone){
                    ch = 'checked';
                }
                output += `
                <div class="product-container">
				<div>
					<input type="checkbox" class="inp-check" ${ch} onclick="setCheckedInArr(${items[i].id})">
					<input type="text" class="item-name" placeholder="Change name to item" value="${items[i].name}" id="inp${items[i].id}">
				</div>
				<div>  
					<button class="list-action-button" onclick="updateListItem(${items[i].id})">Change item</button>
					<button class="list-action-button" onclick="deleteListItem(${items[i].id})">Delete item</button>
				</div>
			    </div>
                `;
            }
            if(output == ''){
                output = `
                <div class="product-container">
				<div>
					<input type="text" class="item-name" placeholder="Change name to item" value="No items">
				</div>
			    </div>
                `;
            }
            itemsContainer.innerHTML = output;
        }
    }

    xhr.send();
}

function hideElements() {
    listNameInput.classList.add(HIDE_CLASS_NAME);
    listCreateBtn.classList.add(HIDE_CLASS_NAME);
    listUpdateBtn.classList.add(HIDE_CLASS_NAME);
    listDeleteBtn.classList.add(HIDE_CLASS_NAME);
}