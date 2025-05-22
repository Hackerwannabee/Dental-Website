function toggleFaq(button) {
    const isActive = button.classList.contains('active');
    document.querySelectorAll('.faq-question').forEach(q => q.classList.remove('active'));
    document.querySelectorAll('.faq-answer').forEach(a => a.classList.remove('open'));
  
    if (!isActive) {
      button.classList.add('active');
      button.nextElementSibling.classList.add('open');
    }
  }