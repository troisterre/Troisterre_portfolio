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
    speed: 2000,
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
  if (window.scrollY > 600) {
    // 600pxスクロールで発動
    header.classList.add("scrolled");
  } else {
    header.classList.remove("scrolled");
  }
});
