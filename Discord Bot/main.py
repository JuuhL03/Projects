import discord # Comandos do discord como ctx 
from discord.ext import commands, tasks
from discord.ui import Button, View, Modal, TextInput

import aiohttp # Para disparar Webhooks e utilizar API
from datetime import datetime # Para tratar os dados de tempo

import asyncio # Para apagar o comando do usuário após ele enviar
import random # Para randomizar o comando !dog
import requests # Para consultar APIs

# ---------------------------------------------------------------------------

# Configura os intents para o bot
intents = discord.Intents.all()

# Inicializa o bot com o prefixo '!' e insensibilidade a maiúsculas e minúsculas
client = commands.Bot(command_prefix='/', case_insensitive=True, intents=intents)

# Webhooks
WEBHOOK_URL_BOT = ''
WEBHOOK_URL_JIRA = ''
WEBHOOK_URL_DISTRIBUTION = ''


# -- TUDO ABAIXO É DO DISCORD DE INTEGRAÇÃO) --
# Canal específico para enviar os logs (logs-do-bot)
LOG_CHANNEL_ID = 12203577 
# Canal específico para enviar o que foi apagado (mensagens-excluídas) 
TRASH_CHANNEL_ID = 123277184  
# Cargo específico para autorizações (</> integração)
INTEGRACAO_ROLE_ID = 12323410 
# - - - - - - - - - - - - - - - - - - - - - - - - - - - -


# -- TUDO ABAIXO É DO DISCORD DE OPERAÇÕES) --
GERAL_CHANNEL_ID = 798014 # Canal específico para enviar mensagem GERAL (geral) 
ELOGIOS_CHANNEL_ID = 123339 # Canal elogios
# CARGOS
N3_ROLE_ID = 110932 # ID do cargo N3
N2_ROLE_ID = 11009764 # ID do cargo N2
SUPERVISOR_ROLE_ID = 119564746 # ID do cargo específico Supervisor
SUPORTE_ROLE_ID = 110576 # ID do cargo Suporte-Geral
# - - - - - - - - - - - - - - - - - - - - - - - - - - - -

# Variável global para verificar se algum comando está em andamento
comando_em_andamento = False
# Variável global para armazenar o nome do último comando executado
ultimo_comando = None

# Função para enviar mensagem para o webhook FLUXO BOT
async def enviar_webhook_bot(texto):
    async with aiohttp.ClientSession() as session:
        data = {'content': texto}
        async with session.post(WEBHOOK_URL_BOT, json=data) as response:

            if response.status == 200: # Se a requisição completar como OK
                print('Mensagem enviada com sucesso para o bot Discord.')

            else: # Caso dê falha na execução
                print('Ocorreu um erro ao enviar a mensagem para o bot Discord.')
                response_text = await response.text()
                print('Texto da resposta:', response_text)


# Função para enviar mensagem para o webhook FLUXO JIRA
async def enviar_webhook_jira(texto):
    async with aiohttp.ClientSession() as session:
        data = {'content': texto}
        async with session.post(WEBHOOK_URL_JIRA, json=data) as response:

            if response.status == 200: # Se a requisição completar como OK
                print('Mensagem enviada com sucesso para o bot Discord.')

            else: # Caso dê falha na execução
                print('Ocorreu um erro ao enviar a mensagem para o bot Discord.')
                response_text = await response.text()
                print('Texto da resposta:', response_text)


# Função para enviar mensagem para o webhook FLUXO DISTRIBUTION
async def enviar_webhook_distribution(texto):
    async with aiohttp.ClientSession() as session:
        data = {'content': texto}
        async with session.post(WEBHOOK_URL_DISTRIBUTION, json=data) as response:

            if response.status == 200: # Se a requisição completar como OK
                print('Mensagem enviada com sucesso para o bot Discord.')

            else: # Caso dê falha na execução
                print('Ocorreu um erro ao enviar a mensagem para o bot Discord.')
                response_text = await response.text()
                print('Texto da resposta:', response_text)


# Função para fazer log de comandos
async def fazer_log(ctx, sucesso=True, erro=None):
    autor = ctx.author
    comando = ctx.command.name
    canal = ctx.channel.name    # O 'F' permite inserir {variáveis} na string
    descricao = "Executou com sucesso" if sucesso else f"Erro: {erro}"

    # Envia a mensagem em forma de Embed
    embed = discord.Embed(
        title="Log de Comando",
        description=f"**Autor:** {autor}\n**Comando:** {comando}\n**Canal:** {canal}\n**Retorno:** {descricao}",
        color=discord.Color.blue()
    )

    # Envia a mensagem de log para o canal específico
    log_channel = client.get_channel(LOG_CHANNEL_ID)
    await log_channel.send(embed=embed)



# Comando '/hello' que envia uma mensagem de teste
@client.command()
async def hello(ctx):
    await fazer_log(ctx)
    await ctx.send(f'Bot testado com sucesso, {ctx.author}')


# Comando '/bot' que envia uma mensagem para o webhook
@client.command()
async def bot(ctx, *, texto): # Retira o '/bot'
    try:
        await fazer_log(ctx)
        await enviar_webhook_bot(texto)  # Envia a mensagem para o webhook
        await ctx.send('Informações inclusas na planilha.')

    except Exception as error:
        await fazer_log(ctx, sucesso=False, erro=str(error))
        await ctx.send("Ocorreu um erro ao enviar o webhook.")


# Comando '/jira' que envia uma mensagem para o webhook
@client.command()
async def jira(ctx, *, texto): # Retira o '/jira'
    try:
        await fazer_log(ctx)
        await enviar_webhook_jira(texto)  # Envia a mensagem para o webhook
        await ctx.send('Webhook foi disparado com sucesso.')

    except Exception as error:
        await fazer_log(ctx, sucesso=False, erro=str(error))
        await ctx.send("Ocorreu um erro ao enviar o webhook.")


# Comando '/dist' que envia uma mensagem para o webhook e dispara a mensagem no canal (DISTRIBUIÇÂO DO SAMUEL)
@client.command()                                                            
async def dist(ctx, *, texto): # Retira o '/dist'
    allowed_role = discord.utils.get(ctx.guild.roles, id=N3_ROLE_ID)

    # Se possuí o cardo </> adm
    if allowed_role in ctx.author.roles:
        try:
            # Aguardar 2 segundos
            await asyncio.sleep(2)

            # Excluir a mensagem do usuário
            await ctx.message.delete()

            await fazer_log(ctx)
            await enviar_webhook_distribution(texto)  # Envia a mensagem para o webhook

            # Mensagem que será enviada para os operadores
            autor = ctx.author.mention
            suporte_role = discord.utils.get(ctx.guild.roles, id=SUPORTE_ROLE_ID)
            mensagem = f"Distribuição do Samuel alterada para {texto}\n"

            embed = discord.Embed(
                title="ALERTA DE ALTERAÇÃO - <:f523:1240034677771866273>",
                description=f"**Autor:** {autor}\n**Mensagem:** {mensagem}",
                color=discord.Color.yellow()
            )
            geral_channel = client.get_channel(GERAL_CHANNEL_ID) # Envia mensagem para o canal GERAL
            await geral_channel.send(suporte_role.mention)
            await geral_channel.send(embed=embed)

        except Exception as error:
            await fazer_log(ctx, sucesso=False, erro=str(error))
            await ctx.author.send("Falha no envio do Webhook")

    # Se ele não possui o cargo
    else:
        await ctx.send("Você não tem permissão para executar este comando.")
        # Registrar o evento nas logs
        print(f'{ctx.author} tentou executar o comando /dist sem permissão.')
        await fazer_log(ctx, sucesso=False, erro="Tentou executar o comando sem permissão")


# Comando '/plat' que atualiza a distribuição e dispara a mensagem no canal (DISTRIBUIÇÂO DA PLATAFORMA)
async def plat(ctx, *, texto): # Retira o '/plat'
    allowed_role = discord.utils.get(ctx.guild.roles, id=N3_ROLE_ID)

    # Se possuí o cardo </> adm
    if allowed_role not in ctx.author.roles:
        await ctx.send("Você não tem permissão para executar este comando.")
        await fazer_log(ctx, sucesso=False, erro="Tentou executar o comando sem permissão")
        return

    try:
        # Aguardar 2 segundos
        await asyncio.sleep(2)

        # Excluir a mensagem do usuário
        await ctx.message.delete()

        await fazer_log(ctx)
        await ctx.send(texto)  # Envia a mensagem para o chat

        # Atualiza a distribuição
        token = '' 
        novo_numero = texto  

        url = 'https://XXXXX/api/v1/distribution/2a3414'
        headers = {
            'Authorization': f'Bearer {token}'
        }
        async with aiohttp.ClientSession() as session:
            async with session.get(url, headers=headers) as response:
                if response.status == 200:
                    data = await response.json()
                    data['maxNum'] = novo_numero
                    async with session.put(url, json=data, headers=headers) as put_response:
                        if put_response.status == 200:
                            print(f"Valor de 'maxNum' atualizado para {novo_numero} com sucesso.")

                            # Mensagem que será enviada para os operadores
                            autor = ctx.author.mention
                            suporte_role = discord.utils.get(ctx.guild.roles, id=SUPORTE_ROLE_ID)
                            mensagem = f"Distribuição da plataforma alterada para {texto}\n"

                            # Envia a mensagem em forma de Embed
                            embed = discord.Embed(
                                title="ALERTA DE ALTERAÇÃO - <:f523:1240034677771866273>",
                                description=f"**Autor:** {autor}\n**Mensagem:** {mensagem}",
                                color=discord.Color.yellow()
                            )
                            geral_channel = client.get_channel(GERAL_CHANNEL_ID) # Envia mensagem para o canal GERAL
                            await geral_channel.send(f"{suporte_role.mention}")
                            await geral_channel.send(embed=embed)

                        else:
                            print(f"Falha ao atualizar 'maxNum' para {novo_numero}.")
                            await fazer_log(ctx, sucesso=False, erro=str(error))

                else:
                    print("Falha ao obter informações da rota.")
                    await fazer_log(ctx, sucesso=False, erro=str(error))


    except Exception as error:
        await fazer_log(ctx, sucesso=False, erro=str(error))



# Comando '/del' que apaga a última mensagem de um @ mencionado
@client.command(name='del')  # Especificando 'del' como nome do comando
async def delete_message(ctx, member: discord.Member):
    trash_channel = client.get_channel(TRASH_CHANNEL_ID)

    # Adicione aqui todos os IDs permitidos
    allowed_role_ids = [N3_ROLE_ID, N2_ROLE_ID, SUPERVISOR_ROLE_ID, INTEGRACAO_ROLE_ID]  
    # Onde role_id é = allowed_role_ids
    allowed_roles = [discord.utils.get(ctx.guild.roles, id=INTEGRACAO_ROLE_ID) for role_id in allowed_role_ids]

    # Aguardar 2 segundos
    await asyncio.sleep(2)

    # Excluir a mensagem do usuário
    await ctx.message.delete()

    # Verifica se o autor tem o cargo permitido
    if any(role in ctx.author.roles for role in allowed_roles):
        async for message in ctx.channel.history(limit=10): # limit = até quantas mensagens do histórico (parâmetro obrigatório)
            if message.author == member:
                cargo = message.author.top_role.name if message.author.top_role else "Nenhum cargo"

                # Formata a data
                data_formatada = message.created_at.strftime("%d/%m/%Y às %H:%M")

                # Envia a mensagem para o repositório em forma de Embed
                embed = discord.Embed(
                    title="Mensagem Excluída",
                    description=f"**Autor:** {member.mention}\n**Cargo:** {cargo}\n**Data de exclusão:** {data_formatada}\n**Conteúdo:** {message.content}",
                    color=discord.Color.red()
                )
                await trash_channel.send(embed=embed)

                try:
                    await fazer_log(ctx)
                    await message.delete()
                    await ctx.author.send(f'Mensagem de {member.mention} excluída com sucesso.')

                except discord.Forbidden:
                    await fazer_log(ctx, sucesso=False, erro="Permissões insuficientes")
                    await ctx.send(f'Ocorreu um erro inesperado ao excluir mensagens de {member.mention}.')
                break
        else:
            await fazer_log(ctx, sucesso=False, erro="Mensagem não encontrada")
            await ctx.author.send(f'Não encontrei mensagens de {member.mention} neste canal.')

    # Se ele não possui o cargo
    else:
        await ctx.send("Você não tem permissão para executar este comando.")
        # Registrar o evento nas logs
        print(f'{ctx.author} tentou executar o comando /del sem permissão.')
        await fazer_log(ctx, sucesso=False, erro="Tentou executar o comando sem permissão")



# Comando /stop para interromper o comando /clearbkp, /test e /clear
@client.command()
async def stop(ctx):
    global comando_em_andamento, ultimo_comando
    if comando_em_andamento:
        comando_em_andamento = False
        await ctx.send(f"Comando {ultimo_comando} interrompido pelo usuário com sucesso.")
        ultimo_comando = None  # Limpa o nome do comando após a interrupção
    else:
        await ctx.send("Não há nenhum comando em andamento.")


''
# Comando /clearbkp para esvaziar o canal realizando backup de mensagens excluídas para outro canal
@client.command()
async def clearbkp(ctx):
    global comando_em_andamento, ultimo_comando
    ultimo_comando = "/clearbkp"

    trash_channel = client.get_channel(TRASH_CHANNEL_ID) # Definindo o canal em que será feito o backup

    # Adicione aqui todos os IDs permitidos
    allowed_role_ids = [N3_ROLE_ID, N2_ROLE_ID, SUPERVISOR_ROLE_ID, INTEGRACAO_ROLE_ID]  
    # Onde role_id é = allowed_role_ids
    allowed_roles = [discord.utils.get(ctx.guild.roles, id=INTEGRACAO_ROLE_ID) for role_id in allowed_role_ids]

    # Verifica se o autor tem o cargo permitido e se não há outro comando em andamento
    if any(role in ctx.author.roles for role in allowed_roles) and not comando_em_andamento:
        comando_em_andamento = True
        async for message in ctx.channel.history(limit=None):
            # Verifica se o comando ainda está em andamento antes de cada iteração
            if not comando_em_andamento:
                break

            # Validação do cargo do usuário
            # Se ele não tiver cargo ou for um bot = Nenhum cargo
            cargo = message.author.top_role.name if isinstance(message.author, discord.Member) and message.author.top_role else "Nenhum cargo" 


            # Envia a mensagem para o repositório em forma de Embed
            embed = discord.Embed(
                title="Mensagem Excluída",
                description=f"**Autor:** {message.author.mention}\n**Cargo:** {cargo}\n**Data de exclusão:** {message.created_at.strftime('%d/%m/%Y às %H:%M')}\n**Conteúdo:** {message.content}",
                color=discord.Color.red()
            )
            await trash_channel.send(embed=embed)

            await asyncio.sleep(1)  # Delay de 1 segundo entre cada exclusão de mensagem
            await message.delete()


        # Verifica se o comando ainda está em andamento antes de enviar a confirmação
        if comando_em_andamento:
            await fazer_log(ctx)
            await ctx.send("Todas as mensagens neste canal foram apagadas com sucesso.", delete_after=5) # Mensagem de confirmação
            comando_em_andamento = False  # Define que não há mais nenhum comando de limpeza em andamento após a execução                                                         

    # Se outro comando está em andamento ou se o autor não possui o cargo permitido
    else:
        if comando_em_andamento:
            await ctx.send("Comando interrompido com sucesso.")
        else:
            await ctx.send("Você não tem permissão para executar este comando ou já há outro comando em andamento.")
            # Registrar o evento nas logs
            print(f'{ctx.author} tentou executar o comando /clearbkp sem permissão ou com outro comando em andamento.')
            await fazer_log(ctx, sucesso=False, erro="Tentou executar o comando sem permissão ou com outro comando em andamento")


# Comando /clear para limpar o canal SEM ENVIAR A MENSAGEM APAGADA (backup)
@client.command()
async def clear(ctx):
    global comando_em_andamento, ultimo_comando
    ultimo_comando = "/clear"

    # Adicione aqui todos os IDs permitidos
    allowed_role_ids = [N3_ROLE_ID, N2_ROLE_ID, SUPERVISOR_ROLE_ID, INTEGRACAO_ROLE_ID]  
    # Onde role_id é = allowed_role_ids
    allowed_roles = [discord.utils.get(ctx.guild.roles, id=INTEGRACAO_ROLE_ID) for role_id in allowed_role_ids]

    # Verifica se o autor tem o cargo permitido e se não há outro comando em andamento
    if any(role in ctx.author.roles for role in allowed_roles) and not comando_em_andamento:
        comando_em_andamento = True
        async for message in ctx.channel.history(limit=None):
            # Verifica se o comando ainda está em andamento antes de cada iteração
            if not comando_em_andamento:
                break
            await asyncio.sleep(1)  # Delay de 1 segundo entre cada exclusão de mensagem
            await message.delete()

        # Verifica se o comando ainda está em andamento antes de enviar a confirmação
        if comando_em_andamento:
            await fazer_log(ctx)
            await ctx.send("Todas as mensagens neste canal foram apagadas com sucesso.", delete_after=5)               # Mensagem de confirmação
            comando_em_andamento = False  # Define que não há mais nenhum comando de limpeza em andamento após a execução                                                         

    # Se outro comando está em andamento ou se o autor não possui o cargo permitido
    else:
        if comando_em_andamento:
            await ctx.send("Comando interrompido com sucesso.")
        else:
            await ctx.send("Você não tem permissão para executar este comando ou já há outro comando em andamento.")
            # Registrar o evento nas logs
            print(f'{ctx.author} tentou executar o comando /clear sem permissão ou com outro comando em andamento.')
            await fazer_log(ctx, sucesso=False, erro="Tentou executar o comando sem permissão ou com outro comando em andamento")



# Comando /test para enviar 15 mensagens no canal
@client.command()
async def test(ctx):
    global comando_em_andamento, ultimo_comando
    ultimo_comando = "/test"
    comando_em_andamento = True

    # Envia 15 mensagens separadas no canal
    for i in range(1, 16):
        await asyncio.sleep(1)  # Delay de 1 segundo entre cada envio de mensagem
        await ctx.send(f'Mensagem {i}')
        if not comando_em_andamento:
            break

    await fazer_log(ctx)

# Para detectar @menção em um #canal específico
@client.event
async def on_message(message):
    # Verifica se a mensagem foi enviada por um bot, incluindo o próprio bot
    if message.author.bot:
        return

    # Log de todas as mensagens em um canal específico
    if message.channel.id == LOG_CHANNEL_ID:
        print(f"Log: {message.author} said: {message.content}")

    # Resposta automática para uma pergunta comum
    if message.content.lower() == "/help":
        await message.channel.send("Olá! Como posso helpr você hoje? Use `/comandos` para ver uma lista de comandos disponíveis.")

    mentioned_users = message.mentions  # Coleta o usuário que foi mencionado
    if message.channel.id == ELOGIOS_CHANNEL_ID:  # Valida se a menção foi no canal específico
        for user in mentioned_users:
            try:
                # Define a mensagem
                mensagem = f"Você recebeu um elogio, confira aqui :) {message.jump_url}"
                await user.send(mensagem)  # Envia para o usuário
            except discord.Forbidden:
                # Se o bot não puder enviar uma mensagem privada
                print('Não foi possível enviar a mensagem privada')

    # Processa outros comandos do bot
    await client.process_commands(message)



# Garantir que esteja dentro da limitação de taxa 
async def delete_message(message, attempt=1):
    try:
        await message.delete()
    except discord.HTTPException as e:
        if e.status == 429:  # Rate limited
            if attempt <= 5:  # Define um limite máximo de retentativas
                retry_after = e.response.headers.get('Retry-After')
                await asyncio.sleep(float(retry_after))
                await delete_message(message, attempt + 1)  # Tenta deletar a mensagem novamente com incremento no contador
            else:
                print("Falha ao deletar as mensagens após muitas tentativas.")


# /dog envia um gif de cachorro aleatório no chat
@client.command()
async def dog(ctx):

    try:
        # Consulta api
        response = requests.get('https://api.thedogapi.com/v1/images/search', params={'mime_types': 'gif'})
        data = response.json()
        gif_url = data[0]['url']
        await ctx.send(gif_url)
        await fazer_log(ctx, sucesso=True, erro=None) # Faz log

    except Exception as error:
        print('Erro ao buscar o gif de dog:', e)
        await ctx.send('Desculpe, houve um erro ao buscar o gif de dog.')
        await fazer_log(ctx, sucesso=False, erro=str(error)) # Faz log






# ----------------------------------------------------------------------------------

# /commands para consultar todos os comandos do bot
@client.command()
async def commands(ctx):
    await fazer_log(ctx)

    trash_channel = client.get_channel(TRASH_CHANNEL_ID)
    elogios_channel = client.get_channel(ELOGIOS_CHANNEL_ID)

    embed = discord.Embed(
        title="Comandos do Ikatekinho",
        description="",
        color=discord.Color.purple()
    )
    embed.add_field(name="/dist value", value="Altera a distribuição do Samuel para Value", inline=True)
    embed.add_field(name="/plat value", value="Altera a distribuição da plataforma para Value", inline=True)
    embed.add_field(name="/del @user", value="Apaga a última mensagem do @user", inline=True)
    embed.add_field(name="/test", value="Envia 15 mensagens de teste no canal", inline=True)
    embed.add_field(name="/clear", value="Apaga todas as mensagens do canal sem realizar backup", inline=True)
    embed.add_field(name="/clearbkp", value=f"Apaga todas as mensagens do canal realizando um backup para #{trash_channel}", inline=False)
    embed.add_field(name="/dog", value="Envia um GIF de dog aleatório", inline=True)
    embed.add_field(name="/jira X", value="Traz retorno sobre jira X", inline=True)
    embed.add_field(name="/bot message", value="Anexa message na planilha do bot", inline=True)
    embed.add_field(name=f"@user em #{elogios_channel}", value=f"Envia uma mensagem no privado do @user mencionado em #{elogios_channel}", inline=True)
    embed.add_field(name="/hello", value="Retorno de mensagem teste", inline=True)
    embed.add_field(name="/stop", value="Interrompe a execução de /clearbkp, /clear ou /test", inline=True)
    embed.add_field(name="/help", value="Retorno rápido para pergunta comum", inline=True)
    embed.add_field(name="/commands", value="Apresenta todos os comandos do bot", inline=True)
    await ctx.send(embed=embed)


# Evento disparado quando o bot está pronto
@client.event
async def on_ready():
    print('Entramos como {0.user}'.format(client))


# Inicia o bot com o token fornecido
client.run('')
