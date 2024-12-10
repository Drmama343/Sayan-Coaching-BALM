<?php 
	$title = "Saiyan's Coaching - Question Admin";
	$style = "stlQuestion.css";
	$navbar = "stlNavbar.css";	
    include __DIR__ . '/../templates/header.php';
	include __DIR__ . '/../templates/navbarAdmin.php';
?>


<div class="conteneur-question">
<?= form_open("/admin/creerQuestion", ['class' => 'form-creation']) ?>
        <div class="question">
            <?= form_label('Question', 'question'); ?>
            <?= form_textarea('question', '', ['required' => 'required', 'placeholder' => 'Écrivez votre question ici...', 'rows' => 2]) ?>
        </div>
        <div class="reponse">
            <?= form_label('Réponse', 'reponse'); ?>
            <?= form_textarea('reponse', '', ['required' => 'required', 'placeholder' => 'Écrivez votre réponse ici...', 'rows' => 4]) ?>
        </div>
        <?= form_submit('submit', 'Ajouter') ?>
    <?= form_close(); ?>

    <div class="recherche">
        <?= form_open('/admin/rechercherQuestion', ['method' => 'post']); ?>
            <?= csrf_field() ?>
            <?= form_label('<h5>Rechercher :</h5>', 'recherche'); ?>
            <?= form_input('recherche',isset($_SESSION['rechercheQuestion']) ? $_SESSION['rechercheQuestion'] : '',['id' => 'recherche', 'onchange' => 'this.form.submit()']); ?>
        <?= form_close(); ?>
    </div>

    <?php foreach ($questions as &$question) : ?>
        <div class="contenu-question">
            <?= form_open("/admin/modifQuestion/" . $question['id'], ['class' => 'form-modif'])?>
                <div class="question">
                    <?= form_label('Question', 'question'); ?>
                    <?= form_textarea('question', $question['question'], ['required' => 'required', 'placeholder' => 'Écrivez votre question ici...', 'rows' => 2]) ?>
                </div>
                <div class="reponse">
                    <?= form_label('Réponse', 'reponse'); ?>
                    <?= form_textarea('reponse', $question['reponse'], ['required' => 'required', 'placeholder' => 'Écrivez votre réponse ici...', 'rows' => 4]) ?>
                </div>
                <?= form_submit('submit', 'Sauvegarder') ?>
            <?= form_close(); ?>

            
            <?= form_open("/admin/supprimerQuestion/".$question['id'], ['class' => 'form-suppression', 'onsubmit' => "return confirm('Êtes-vous sûr de vouloir supprimer cette question ?');"]) ?>
                <?= form_hidden('id_question', $question['id']) ?>
                <?= form_submit('submit', 'Supprimer', ['class' => 'btn-supprimer']) ?>
            <?= form_close(); ?>
        </div>
    <?php endforeach; ?>
    <!-- Affichage des liens de pagination -->
    <div id="paginationQuestion">
        <?= $pagerQuestions->links('Question', 'custom') ?>
    </div>
</div>



<?php include __DIR__ . '/../templates/footer.php'; ?>