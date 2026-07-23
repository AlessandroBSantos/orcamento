/*
=====================================================
FOCO AUTOMÁTICO NO CAMPO E-MAIL
=====================================================

Este script é executado assim que a página
é completamente carregada.

Sua função é localizar o campo de e-mail
e posicionar automaticamente o cursor
nesse campo, proporcionando uma melhor
experiência para o usuário durante o login.

=====================================================
*/

document.addEventListener("DOMContentLoaded",()=>{

    // Localiza o campo de entrada (input)
    // cujo atributo "name" é igual a "email".
    const email=document.querySelector("input[name=email]");

    // Posiciona automaticamente o cursor
    // no campo de e-mail quando a página
    // termina de carregar.
    email.focus();

});