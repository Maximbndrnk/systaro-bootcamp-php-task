<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,600" rel="stylesheet">
	<link rel="stylesheet" href="./styles/style.css">
	<?php include './php/init-db.php';?>
	<title>ShoppingMe</title>
</head>

<body>
	<div class="header-container">
		<p class="header-title">ShoppingMe</p>
		<p class="secondary-title">Creating shopping list - easy!</p>
	</div>
	<div class="body-container">
		<div class="many-list-container">
			<div class="add-new-list-container" onclick="showAddListForm()">
				<p class="secondary-title add-new">Add new list</p>
			</div>
			<div class="avaliavle-lists-label">
				Avaliable lists:
			</div>
			<div class="avaliable-lists" id="listsContainer"></div>
		</div>
		<div class="list-container">
			<div class="create-edit-list-container">
				<input type="text" placeholder="Enter list name" id="listNameInput" class="hidden-object">
				<div>
					<button class="list-action-button hidden-object"
					 onclick="addNewList()" id="listCreateBtn">Create</button>
					<button class="list-action-button hidden-object"
					 onclick="updateList()" id="listUpdateBtn">Change name</button>
					<button class="list-action-button hidden-object"
					 onclick="deleteList()" id="listDeleteBtn">Delete list</button>
				</div>
			</div>
			<div class="avaliavle-lists-label">
				Add new item:
			</div>
			<div class="create-edit-list-container add-item-to-list">
				<input type="text" placeholder="Enter item here" id="itemNameInput">
				<div>
					<button class="list-action-button" onclick="addNewItemToList()" id="createItemButton">Create</button>
				</div>
			</div>
			<div class="avaliavle-lists-label">
				Shopping list:
			</div>
			<div class="avaliable-lists" id="itemsContainer">
			<div class="product-container">
				<div>
					<input type="text" class="item-name" placeholder="Change name to item" value="No items">
				</div>
			    </div>
			</div>

			
		</div>
	</div>

	<script src="./js/script.js"></script>
</body>

</html>