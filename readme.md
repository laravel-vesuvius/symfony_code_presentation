# Symfony code presentation

## CartFactory.php

It contains code to create cart instance depending on user role, also there is possibility to change store class for cart.

## HistoryItemInterface.php

It contains interface to implement history logs, and possibility to rollback changes. It helps to design "command" architecture pattern.

## HistoryManager.php

It allows to log history item in database and creates a corresponding PHP object from a logged record.

## PricesCalculator.php

This class allows to dynamically calculate product price depending on some logic.
