<div class="d-none d-md-block">
    <div class="feedback-sidebar">
        <div class="feedback-sidebar__initial visible">
            <h3 class="feedback-sidebar__heading">Обратная связь</h3>
            <div class="feedback-sidebar__description">Вы можете задать любой вопрос или помочь нам советом</div>
            <div class="feedback-sidebar__form d-md-none d-lg-block">
                <form method="post" id="feedback_main" action="javascript:void(null);" enctype="multipart/form-data" onsubmit="LoadAjaxForm('feedback_main', '/ajax/feedback.php', 'feedback')"  >
                    <input type="text" class="form-input" name="email" placeholder="Ваша эл. почта или телефон">
                    <textarea class="form-input" name="comments" placeholder="Ваше сообщение"></textarea>
                    <input type="submit" class="btn btn-scarlet" value="Отправить" />
                </form>
            </div>
			<a href="/partners/" class="btn btn-scarlet feedback-sidebar__link d-none d-md-flex d-lg-none">Написать</a>
        </div>
        <div  class="feedback-sidebar__sended">
            <h3 class="feedback-sidebar__heading">Ваше сообщение отправлено</h3>
            <div class="feedback-sidebar__description">Мы ответим Вам в самое ближайщее время.</div>
            <a href="#" class="feedback-sidebar__link-more">Отправить еще сообщение</a>
        </div>
    </div>
</div>