document.addEventListener("DOMContentLoaded", () => {
  const target = document.getElementById("js-type-target");
  if (!target) {
    console.warn("#js-type-target が見つかりません。");
    return;
  }
  const rawCode = `const codeLines = escapeHtml(rawCode).split
("\n");
let line = 0;
let char = 0;
function type() {
  if (line < codeLines.length) {
    const currentLine = codeLines[line];
    if (char < currentLine.length) {
      target.innerHTML += currentLine.charAt
(char);
      char++;
      target.scrollTop = target.
scrollHeight; // スクロール
      setTimeout(type, 15); 
    } else {
      target.innerHTML += "\n"; 
      line++;
      char = 0;
      target.scrollTop = target.
scrollHeight; // スクロール
      setTimeout(type, 100); 
    }
  }
}
type();`;

  function escapeHtml(str) {
    return str
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#39;");
  }

  const codeLines = escapeHtml(rawCode).split("\n");

  let line = 0;
  let char = 0;

  function type() {
    if (line < codeLines.length) {
      const currentLine = codeLines[line];
      if (char < currentLine.length) {
        target.innerHTML += currentLine.charAt(char);
        char++;
        target.scrollTop = target.scrollHeight; // スクロール
        setTimeout(type, 15); // 文字単位
      } else {
        target.innerHTML += "\n"; // 改行
        line++;
        char = 0;
        target.scrollTop = target.scrollHeight; // スクロール
        setTimeout(type, 100); // 行間の待ち時間
      }
    }
  }

  type(); // 開始！
});
document.addEventListener("DOMContentLoaded", () => {
  new Swiper(".js-main-slider", {
    loop: true,
    autoplay: {
      delay: 3000,
    },
    effect: "fade",
    speed: 3000,
  });
  new Swiper(".js-work-slider", {
    loop: true,
    spaceBetween: 20,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    slidesPerView: 1,
    breakpoints: {
      560: {
        slidesPerView: 2,
      },
    },
  });
});
document.addEventListener("DOMContentLoaded", () => {
  const hamburger = document.querySelector(".js-hamburger");
  const nav = document.querySelector(".js-nav");
  const navLinks = document.querySelectorAll(".js-nav-link");

  const closeMenu = () => {
    hamburger.classList.remove("active");
    nav.classList.remove("active");
  };

  hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    nav.classList.toggle("active");
  });
  // リンククリックでメニューを閉じる
  navLinks.forEach((link) => {
    link.addEventListener("click", () => {
      closeMenu();
    });
  });
  // リサイズ時にメニューを閉じる
  window.addEventListener("resize", () => {
    if (window.innerWidth > 768) {
      closeMenu();
    }
  });
});
window.addEventListener("scroll", () => {
  const header = document.querySelector(".l-header");
  if (window.scrollY > 50) {
    // 50pxスクロールで発動
    header.classList.add("scrolled");
  } else {
    header.classList.remove("scrolled");
  }
});
//contact//
document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector(".wpcf7-form");
  const modal = document.getElementById("confirmation-modal");
  const modalSubmit = document.getElementById("modal-submit");
  const modalCancel = document.getElementById("modal-cancel");
  const trigger = document.getElementById("open-confirmation-modal");

  // --- 必須項目に required 属性を強制追加 ---
  const requiredFields = document.querySelectorAll(
    ".wpcf7-validates-as-required"
  );
  requiredFields.forEach((field) => {
    field.setAttribute("required", "required");
  });

  // --- フォームが存在しない場合は終了 ---
  if (!form) {
    console.warn("フォームが見つかりません。");
    return;
  }

  const realSubmitButton = form.querySelector(".c-button__contact-none");

  if (!realSubmitButton) {
    console.warn(".c-button__contact-none が見つかりません。");
    return;
  }

  // --- モーダルの事前確認表示 ---
  if (trigger && modal && modalSubmit && modalCancel) {
    trigger.addEventListener("click", function () {
      const name = form.querySelector('[name="your-name"]');
      const kana = form.querySelector('[name="your-kana"]');
      const email = form.querySelector('[name="your-email"]');
      const message = form.querySelector('[name="your-message"]');
      const acceptance = form.querySelector('[name="acceptance-415"]');

      // HTML5バリデーション（モーダル前に必須確認）
      if (!form.checkValidity()) {
        form.reportValidity();
        return;
      }

      document.getElementById("confirm-name").textContent = name.value;
      document.getElementById("confirm-kana").textContent = kana.value;
      document.getElementById("confirm-email").textContent = email.value;
      document.getElementById("confirm-message").textContent = message.value;

      modal.style.display = "flex";
    });

    // --- モーダルから実際に送信 ---
    modalSubmit.addEventListener("click", function () {
      modal.style.display = "none";
      const realSubmit = document.getElementById("real-submit");
      if (realSubmit) {
        console.log("real-submit をクリックします");
        realSubmit.click(); // ← ここで Contact Form 7 の submit ボタンをクリック
      } else {
        console.error("real-submit ボタンが見つかりません");
      }
    });

    // --- モーダルキャンセル ---
    modalCancel.addEventListener("click", function () {
      modal.style.display = "none";
    });
  }

  // --- 送信完了後リダイレクト ---
  document.addEventListener("wpcf7mailsent", function () {
    window.location.href = "/thanks";
  });
});
