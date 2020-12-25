<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="container">
    <div class="alert alert-danger alert-dismissible" style="display:none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <span class="msg"></span>
    </div>

    <div class="row main-row">
        <div class="col-md-offset-4 col-md-4">
            <div class="form-group">
                <label>Уникальный номер заема</label>
                <input id="loan_id" type="number" min="1" class="form-control" placeholder="Введите номер заема">
            </div>
            <button id="search" class="btn btn-block btn-primary">Поиск</button>
        </div>
    </div>

    <br>
    <br>
    <div class="schedule-payment" style="display: none">
        <h3>График платежей:<span id="loan-id"></span></h3>
        <table class="table table-bordered payment-schedule">
            <thead>
            <tr>
                <th>Номер платежа</th>
                <th>Дата платежа</th>
                <th>Ежемесячный платеж</th>
                <th>Сумма погашаемых %</th>
                <th>Сумма погашаемого основного долга</th>
                <th>Остаток основного долга</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
