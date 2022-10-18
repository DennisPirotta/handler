<!-- Just an image -->
<nav class="navbar-dark fixed-bottom shadow-6">
    <div class="container  bg-darker">
        <div class="navbar-nav d-flex">
            <div class="row">
                <x-navbar-item :redirect="route('home')" :icon="'bi-house'" :title="'Home'"></x-navbar-item>
                <x-navbar-item :redirect="route('transactions.index')" :icon="'bi-arrow-down-up'" :title="'Movimenti'"></x-navbar-item>
                <x-navbar-item :redirect="route('customers.index')" :icon="'bi-wallet2'" :title="'Debiti'"></x-navbar-item>
                <x-navbar-item :redirect="route('users.index')" :icon="'bi-person'" :title="'Profilo'"></x-navbar-item>
            </div>
        </div>
    </div>
</nav>
