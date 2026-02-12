FROM rust:latest

ARG GROUPID
ARG USERID
ARG GROUP_NAME
ARG USER_NAME

USER root

RUN groupadd -g ${GROUPID} ${GROUP_NAME} && \
    useradd -u ${USERID} -g ${GROUPID} -m ${USER_NAME}

RUN apt update
RUN apt install curl wget -y
RUN apt install git lazygit fzf curl ripgrep -y


# Neovim
RUN wget https://github.com/neovim/neovim-releases/releases/download/v0.11.4/nvim-linux-x86_64.deb -O /tmp/nvim.deb
RUN apt install /tmp/nvim.deb -y

# RUN curl -sSf https://raw.githubusercontent.com/WasmEdge/WasmEdge/master/utils/install.sh | bash -s -- -p /usr/local

USER ${USER_NAME} 

# RUN cargo install bacon
RUN cargo install watchexec-cli
# RUN cargo install cargo-audit
# RUN cargo install cargo-expand
# RUN cargo install cargo-vet
# RUN cargo install cargo-bloat
# RUN cargo install cargo-release
# RUN cargo install git-cliff
# RUN cargo install mdbook
RUN cargo install just
# RUN cargo install cargo-msrv
# RUN cargo install cargo-license
RUN rustup component add rustfmt
RUN rustup component add clippy
RUN rustup component add rust-analyzer



# RUN git clone https://github.com/LazyVim/starter ~/.config/nvim
# RUN rm -rf ~/.config/nvim/.git


WORKDIR /projects



ENTRYPOINT ["tail", "-f","/dev/null"]
