
<?php 

if (!isset($_SESSION)) session_start();



    require_once("conexao/conexao.php");

    try {

        
        // Configuração da busca
        $termoBusca = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : '';
        $condicaoBusca = '';
        
        if (!empty($termoBusca)) {
            $condicaoBusca = " WHERE t.descricao LIKE :termo ";
        }
        
        // Consulta para contar o total de registros
        $sqlCount = "SELECT COUNT(*) as total FROM tbmoveis t" . $condicaoBusca;
        $stmtCount = $conn->prepare($sqlCount);
        
        if (!empty($termoBusca)) {
            $termoParam = '%' . $termoBusca . '%';
            $stmtCount->bindParam(':termo', $termoParam, PDO::PARAM_STR);
        }
        
        $stmtCount->execute();
        $totalRegistros = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];

        
        // Consulta para buscar os registros da página atual
        $sqlMoveis = "SELECT *
                FROM tbmoveis t"
                . 
                $condicaoBusca 
                . " ORDER BY t.descricao ASC";
        
        $selectMoveis = $conn->prepare($sqlMoveis);
        
        if (!empty($termoBusca)) {
            $termoParam = '%' . $termoBusca . '%';
            $selectMoveis->bindParam(':termo', $termoParam, PDO::PARAM_STR);
        }

        $selectMoveis->execute();        
        $moveis = $selectMoveis->fetchAll(PDO::FETCH_ASSOC);


        // ---------
        if (!empty($termoBusca)) {
            $condicaoBusca = " WHERE t.nome LIKE :termo ";
        }

        // sql salas
        $sqlSalas = "SELECT *        
                FROM tbsalas t"
                . 
                $condicaoBusca 
                . " ORDER BY t.nome ASC";
        
        $selectSalas = $conn->prepare($sqlSalas);
        
        if (!empty($termoBusca)) {
            $termoParam = '%' . $termoBusca . '%';
            $selectSalas->bindParam(':termo', $termoParam, PDO::PARAM_STR);
        }

        $selectSalas->execute();        
        $salas = $selectSalas->fetchAll(PDO::FETCH_ASSOC);

        $titulo = "Moveis e salas";
    } catch(PDOException $e) {
        echo "<div class='alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
    }
?>

<div class="row">
    <div class="col-md-12">
        <h2 class="page-header"><?php echo $titulo; ?></h2>
        
        <div class="row search-container">
            <div class="col-md-6">
                <form method="POST" action="executabusca.php" class="d-flex">
                    <input type="text" name="pesquisa" class="form-control me-2" placeholder="Buscar por descrição" value="<?php echo htmlspecialchars($termoBusca); ?>">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="cadastrotarefa.php" class="btn btn-success">
                    <i class="material-icons align-middle">add</i> Nova Tarefa
                </a>
            </div>
        </div>

        <?php if (count($moveis) > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="30%">Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($moveis as $movel): ?>
                            <tr>
                                <td><?php echo $movel['id_movel']; ?></td>
                                <td><?php echo htmlspecialchars($movel['descricao']); ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>      
    
        <?php else: ?>
            <div class="alert alert-info">
                Nenhum movel encontrado.
            </div>
        <?php endif ?>

        <?php if (count($salas) > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="30%">Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($salas as $sala): ?>
                            <tr>
                                <td><?php echo $sala['id_sala']; ?></td>
                                <td><?php echo htmlspecialchars($sala['nome']); ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>      
    
        <?php else: ?>
            <div class="alert alert-info">
                Nenhuma sala encontrada.
            </div>
        <?php endif ?>

    </div>
</div>

