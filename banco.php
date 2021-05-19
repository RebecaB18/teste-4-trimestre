<?php

    function bancoConecta() 
    {
       

        $host = 'localhost';
        $usuario = 'root';
        $senha = '';
        $banco = 'world';

        /* abre a conexão */
        $link = mysqli_connect($host,$usuario,$senha);
        if(!$link)
        {
            /* não conseguiu abrir a conexão */
            echo "Erro de conexao: " . mysqli_connect_error();
            die();
        }

        /* seleciona o banco de dados */
        if(!mysqli_select_db($link, $banco))
        {
            /* erro ao selecionar o banco de dados */
            echo "Erro na selecao do banco: " . mysqli_error($link);
            mysqli_close($link);
            die();
        }

        // register_shutdown_function(mysqli_close,$link);

        register_shutdown_function(function() use ($link) {
            mysqli_close($link);
        });

        return $link;
    }

    function executaSelect($link, $sql)
    {
        /* enviando a consulta para o banco de dados */
	    $resposta = mysqli_query($link, $sql);
	    if($resposta)
	    {
            /* deu certo!! mostar o resultado */
            /* pega a primeira linha */
    		$linha = mysqli_fetch_assoc($resposta);
            while($linha)
            {
                // Faz algo com a linha
                yield $linha;
                $linha = mysqli_fetch_assoc($resposta);
            }
        }
        else
        {
            echo mysqli_error($link);
        }
    }
?>
<link rel="stylesheet" href="css/bootstrap.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>