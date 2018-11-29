<?php
include 'constants.php';
spl_autoload_register('classLoader');
session_start();

try
{
	$portal = new PortalFront("localhost", "root", "", "aplikacja_budzetowa");
	
	$action = "showMain";
	if(isset($_GET['action'])) {
		
		$action = $_GET['action'];
	}
	
	$news = $portal->getNews();
	if(!$news && $action == 'showLogin') {
		$news = "Wprowadź nazwę i hasło użytkownika";
	}
	
	if(($action == 'showLogin' || $action == 'showRegistration') && $portal->loged) {
		
		$portal->setNews('Najpierw musisz się wylogować.');
		header('Location:index.php?action=showMenu');
		return;
	}
	

	
	switch($action){
		 case 'login' : 
      switch($portal->login()){
        case ACTION_OK : 
          $portal->setNews("Logowanie prawidłowe.");
          header('Location:index.php?action=showMenu');
          return;
        case NO_LOGIN_REQUIRED : 
          $portal->setNews('Najpierw proszę się wylogować.');
          header('Location:index.php?action=showMenu');
          return;
        case ACTION_FAILED :
        case FORM_DATA_MISSING :
          $portal->setNews('Błędna nazwa lub hasło użytkownika');
		  header('Location:index.php?action=showLogin');
          return;
        default:
          $portal->setNews(
            'Błąd serwera. Zalogowanie nie jest obecnie możliwe.');
      }
      header('Location:index.php?action=showLoginForm');
      break;
		case 'logout' :
			$portal->logout();
			header('Location:index.php?action=showMain');
			break;
		case 'registerUser':
			switch($portal->registerUser()){
				case ACTION_OK:
				  $portal->setNews('Rejestracja zakończona sukcesem.');
				  header('Location:index.php?action=showLogin');
				  return;
				case PASSWORD_DO_NOT_MATCH:
					$portal->setNews('Oba hasła muszą być takie same!');
					break;
				case USER_NAME_ALREADY_EXISTS:
					$portal->setNews('Podana nazwa jest już zajęta!');
					break;
				case ACTION_FAILED:
				case FORM_DATA_MISSING:
					$portal->setNews('Brak możliwości rejestracji w obecnej chwili!');
					break;
				case SERVER_ERROR:
				default:
					$portal->setNews('Błąd serwera');
			}
				header('Location:index.php?action=showRegistration');
				break;
		case 'addIncome':
			switch($portal->addValues()){
				case ACTION_OK:
				  $portal->setNews('Dodano przychód.');
				  header('Location:index.php?action=showAddIncomes');
				  return;
				case ACTION_FAILED:
				case FORM_DATA_MISSING:
					$portal->setNews($_POST['category'] );
					break;
				case SERVER_ERROR:
				default:
					$portal->setNews('Błąd serwera');
			}
				header('Location:index.php?action=showAddIncomes');
				break;
			case 'addExpense':
			switch($portal->addExpense()){
				case ACTION_OK:
				  $portal->setNews('Dodano wydatek.');
				  header('Location:index.php?action=showAddExpenses');
				  return;
				case ACTION_FAILED:
				case FORM_DATA_MISSING:
					$portal->setNews('Nie udało się dodać wydatku!');
					break;
				case SERVER_ERROR:
				default:
					$portal->setNews('Błąd serwera');
			}	
				header('Location:index.php?action=showAddExpenses');
				break;
			case 'newName':
			switch($portal->changeName()){
				case ACTION_OK:
				$portal->logout();
				$portal->setNews('Imię zostało zmienione. Należy się ponownie zalogować.');
				  header('Location:index.php?action=showMain');
				  return;
				case ACTION_FAILED:
				case FORM_DATA_MISSING:
					$portal->setNews('Nie udało się zmienić imienia!');
					break;
				case SERVER_ERROR:
				default:
					$portal->setNews('Błąd serwera');
			}	
			case 'newPassword':
			switch($portal->changePassword()){
				case ACTION_OK:
				$portal->logout();
				$portal->setNews('Hasło zostało zmienione. Należy się ponownie zalogować.');
				  header('Location:index.php?action=showMain');
				  return;
				 case PASSWORD_DO_NOT_MATCH:
					$portal->setNews('Oba hasła muszą być takie same!');
					break; 
				case ACTION_FAILED:
				case FORM_DATA_MISSING:
					$portal->setNews('Nie udało się zmienić hasła!');
					break;
				case SERVER_ERROR:
				default:
					$portal->setNews('Błąd serwera');
			}	
			case 'newIncomes':
			switch($portal->changeIncomeCategory()){
				case ACTION_OK:
				$portal->setNews('Nazwa kategorii została poprawnie zmieniona.');
				  header('Location:index.php?action=showSettings');
				  return;
				case ACTION_FAILED:
				case FORM_DATA_MISSING:
					$portal->setNews('Nie udało się zmienić nazwy kategorii!');
					break;
				case SERVER_ERROR:
				default:
					$portal->setNews('Błąd serwera');
			}	
			case 'newExpenses':
			switch($portal->changeExpenseCategory()){
				case ACTION_OK:
				$portal->setNews('Nazwa kategorii została poprawnie zmieniona.');
				  header('Location:index.php?action=showSettings');
				  return;
				case ACTION_FAILED:
				case FORM_DATA_MISSING:
					$portal->setNews('Nie udało się zmienić nazwy kategorii!');
					break;
				case SERVER_ERROR:
				default:
					$portal->setNews('Błąd serwera');
			}	
			case 'newPayment':
			switch($portal->changePaymentCategory()){
				case ACTION_OK:
				$portal->setNews('Nazwa kategorii została poprawnie zmieniona.');
				  header('Location:index.php?action=showSettings');
				  return;
				case ACTION_FAILED:
				case FORM_DATA_MISSING:
					$portal->setNews('Nie udało się zmienić nazwy kategorii!');
					break;
				case SERVER_ERROR:
				default:
					$portal->setNews('Błąd serwera');
			}	
			case 'addNewCotegoryOfIncomes':
			switch($portal->addNewIncomes()){
				case ACTION_OK:
				$portal->setNews('Nowa kategorii została dodana.');
				  header('Location:index.php?action=showSettings');
				  return;
				case ACTION_FAILED:
				case FORM_DATA_MISSING:
					$portal->setNews('Nie udało się zmienić nazwy kategorii!');
					break;
				case SERVER_ERROR:
				default:
					$portal->setNews('Błąd serwera');
			}
			case 'addNewCotegoryOfExpenses':
			switch($portal->addNewExpenses()){
				case ACTION_OK:
				$portal->setNews('Nowa kategorii została dodana.');
				  header('Location:index.php?action=showSettings');
				  return;
				case ACTION_FAILED:
				case FORM_DATA_MISSING:
					$portal->setNews('Nie udało się zmienić nazwy kategorii!');
					break;
				case SERVER_ERROR:
				default:
					$portal->setNews('Błąd serwera');
			}
			case 'deleteCategoryOfIncomes':
			switch($portal->deleteIncomes()){
				case ACTION_OK:
				$portal->setNews('Kategoria została usunięta.');
				  header('Location:index.php?action=showSettings');
				  return;
				case ACTION_FAILED:
				case FORM_DATA_MISSING:
					$portal->setNews('Nie udało się zmienić nazwy kategorii!');
					break;
				case SERVER_ERROR:
				default:
					$portal->setNews('Błąd serwera');
			}
			case 'deleteCategoryOfExpenses':
			switch($portal->deleteExpenses()){
				case ACTION_OK:
				$portal->setNews('Kategoria została usunięta.');
				  header('Location:index.php?action=showSettings');
				  return;
				case ACTION_FAILED:
				case FORM_DATA_MISSING:
					$portal->setNews('Nie udało się zmienić nazwy kategorii!');
					break;
				case SERVER_ERROR:
				default:
					$portal->setNews('Błąd serwera');
			}
			case 'addNewCategoryOfPayment':
			switch($portal->addPaymentCategory()){
				case ACTION_OK:
				$portal->setNews('Kategoria została dodana.');
				  header('Location:index.php?action=showSettings');
				  return;
				case ACTION_FAILED:
				case FORM_DATA_MISSING:
					$portal->setNews('Nie udało się zmienić nazwy kategorii!');
					break;
				case SERVER_ERROR:
				default:
					$portal->setNews('Błąd serwera');
			}
			case 'deleteCategoryOfPayment':
			switch($portal->deletePayment()){
				case ACTION_OK:
				$portal->setNews('Kategoria została usunięta.');
				  header('Location:index.php?action=showSettings');
				  return;
				case ACTION_FAILED:
				case FORM_DATA_MISSING:
					$portal->setNews('Nie udało się zmienić nazwy kategorii!');
					break;
				case SERVER_ERROR:
				default:
					$portal->setNews('Błąd serwera');
			}
				default: 
					include 'templates/basicTemplate.php';	
	}
} catch(Exception $e) {
	
	echo $e;
	exit('Serwis chwilowo niedostępny');
}

function classLoader($name) {
	
	if(file_exists("class/$name.php")){
		require_once("class/$name.php");
	} else {
		throw new Exception("Brak pliku z definicją klasy.");
	}
}
?>