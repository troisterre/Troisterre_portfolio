document.addEventListener("DOMContentLoaded", () => {
  const target = document.getElementById("js-type-target");

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

  if (form) {
    form.addEventListener("submit", function (e) {
      const requiredFields = form.querySelectorAll("[required]");
      const allFields = form.querySelectorAll("input, textarea");
      const errorMessage = form.querySelector(".wpcf7-response-output");

      let anyInputFilled = false;
      let hasEmptyRequired = false;

      allFields.forEach((field) => {
        if (field.value.trim() !== "") {
          anyInputFilled = true;
        }
      });

      requiredFields.forEach((field) => {
        if (field.value.trim() === "") {
          hasEmptyRequired = true;
        }
      });

      if (anyInputFilled && hasEmptyRequired) {
        e.preventDefault();
        if (errorMessage) {
          errorMessage.style.display = "block";
          errorMessage.textContent =
            "入力内容に問題があります。確認して再度お試しください。";
        }
      } else if (errorMessage) {
        errorMessage.style.display = "none";
      }
    });
  }
});

//モーダル表示//

document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector(".wpcf7-form");
  const modal = document.getElementById("confirmation-modal");
  const modalSubmit = document.getElementById("modal-submit");
  const modalCancel = document.getElementById("modal-cancel");
  const trigger = document.getElementById("open-confirmation-modal");

  const realSubmitButton = form.querySelector(".c-button__contact-none"); // ← ここ変更！

  if (
    !form ||
    !modal ||
    !modalSubmit ||
    !modalCancel ||
    !trigger ||
    !realSubmitButton
  ) {
    console.error("必要な要素が見つかりません。");
    return;
  }

  // モーダル表示
  trigger.addEventListener("click", function () {
    document.getElementById("confirm-name").textContent =
      form.querySelector('[name="your-name"]').value;
    document.getElementById("confirm-kana").textContent =
      form.querySelector('[name="your-kana"]').value;
    document.getElementById("confirm-email").textContent = form.querySelector(
      '[name="your-email"]'
    ).value;
    document.getElementById("confirm-message").textContent = form.querySelector(
      '[name="your-message"]'
    ).value;

    modal.style.display = "flex";
  });

  // モーダル内送信
  modalSubmit.addEventListener("click", function () {
    modal.style.display = "none";
    realSubmitButton.click(); // ← 実際の送信
  });

  // キャンセル
  modalCancel.addEventListener("click", function () {
    modal.style.display = "none";
  });

  // 送信完了後のリダイレクト
  document.addEventListener("wpcf7mailsent", function () {
    window.location.href = "/thanks";
  });
});
