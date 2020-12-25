<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="container">
    <div class="alert alert-success alert-dismissible" style="display: none">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <span class="msg"></span>
    </div>
    <div class="alert alert-danger alert-dismissible" style="display:none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <span class="msg"></span>
    </div>

    <div class="row main-row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Начальная дата</label>
                <input id="start-date" type="date" class="form-control" placeholder="Enter ...">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Сумма займа</label>
                <input id="amount" type="number" min="1" class="form-control" placeholder="Сумма займа">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Срок займа (в месяцах)</label>
                <input id="term" type="number" min="1" class="form-control" placeholder="Срок займа (в месяцах)">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Годовая процентная ставка</label>
                <input id="percent" type="number" min="1" class="form-control" placeholder="Годовая процентная ставка">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <button id="send" class="btn btn-block btn-primary">Отправить</button>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="schedule-payment" style="display: none">
        <h3>График платежей:<span id="loan-id"></span></h3>
        <table class="table table-bordered payment-schedule" style="text-align: center;">
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
